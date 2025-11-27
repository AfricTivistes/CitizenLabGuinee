# 🔄 Configuration du Build Automatique WordPress → Netlify

Ce guide explique comment configurer WordPress pour déclencher automatiquement un rebuild sur Netlify lorsqu'un article est publié, mis à jour ou supprimé.

## 📋 Prérequis

- ✅ Build Hook Netlify : `https://api.netlify.com/build_hooks/6925c9bcd4a1d9211ea592d1`
- ✅ Accès à l'administration WordPress
- ✅ Accès au fichier `functions.php` ou possibilité d'installer un plugin

## 🎯 Méthode 1 : Code PHP dans functions.php (Recommandé)

### Étape 1 : Ajouter le code dans functions.php

1. Connectez-vous à votre WordPress : `https://citizenlab.africtivistes.org/guinee/wp-admin`
2. Allez dans **Apparence → Éditeur de thème → functions.php**
3. Ajoutez ce code à la fin du fichier :

```php
<?php
/**
 * Netlify Build Hook - Déclenche un rebuild automatique
 * Quand un article est publié, mis à jour ou supprimé
 */

// URL de votre Build Hook Netlify
define('NETLIFY_BUILD_HOOK_URL', 'https://api.netlify.com/build_hooks/6925c9bcd4a1d9211ea592d1');

/**
 * Fonction pour déclencher le build Netlify
 */
function trigger_netlify_build() {
    $build_hook_url = NETLIFY_BUILD_HOOK_URL;
    
    // Envoyer une requête POST au build hook
    $response = wp_remote_post($build_hook_url, array(
        'method' => 'POST',
        'timeout' => 30,
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
        'body' => json_encode(array(
            'trigger_title' => 'WordPress Content Update',
            'triggered_by' => 'WordPress',
        )),
    ));
    
    // Log pour le débogage (optionnel)
    if (is_wp_error($response)) {
        error_log('Netlify Build Hook Error: ' . $response->get_error_message());
    } else {
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code === 200) {
            error_log('Netlify Build Hook Success: Build triggered successfully');
        } else {
            error_log('Netlify Build Hook Warning: Response code ' . $response_code);
        }
    }
}

// Déclencher le build quand un article est publié
add_action('publish_post', 'trigger_netlify_build');

// Déclencher le build quand un article est mis à jour
add_action('save_post', 'trigger_netlify_build');

// Déclencher le build quand un article est supprimé
add_action('delete_post', 'trigger_netlify_build');

// Déclencher le build quand une page est publiée/mise à jour
add_action('publish_page', 'trigger_netlify_build');
add_action('save_page', 'trigger_netlify_build');

// Déclencher le build quand un commentaire est approuvé
add_action('wp_set_comment_status', function($comment_id, $status) {
    if ($status === 'approve') {
        trigger_netlify_build();
    }
}, 10, 2);
?>
```

### Étape 2 : Tester le webhook

1. Publiez ou modifiez un article dans WordPress
2. Vérifiez dans Netlify que le build se déclenche automatiquement
3. Allez dans **Netlify → Deploys** pour voir le nouveau build

## 🎯 Méthode 2 : Plugin WordPress (Alternative)

### Option A : Plugin "Netlify Deploy"

1. Allez dans **Extensions → Ajouter**
2. Recherchez "Netlify Deploy" ou "Netlify Build Hook"
3. Installez et activez le plugin
4. Configurez le Build Hook URL dans les paramètres du plugin

### Option B : Plugin personnalisé

Créez un fichier `netlify-build-hook.php` dans `/wp-content/plugins/` :

```php
<?php
/**
 * Plugin Name: Netlify Build Hook
 * Description: Déclenche automatiquement un rebuild Netlify lors de la publication/modification d'articles
 * Version: 1.0.0
 * Author: CitizenLab Guinée
 */

if (!defined('ABSPATH')) {
    exit;
}

class NetlifyBuildHook {
    private $build_hook_url = 'https://api.netlify.com/build_hooks/6925c9bcd4a1d9211ea592d1';
    
    public function __construct() {
        add_action('publish_post', array($this, 'trigger_build'));
        add_action('save_post', array($this, 'trigger_build'));
        add_action('delete_post', array($this, 'trigger_build'));
        add_action('publish_page', array($this, 'trigger_build'));
    }
    
    public function trigger_build() {
        wp_remote_post($this->build_hook_url, array(
            'method' => 'POST',
            'timeout' => 30,
        ));
    }
}

new NetlifyBuildHook();
```

## 🔍 Vérification et Débogage

### Vérifier que le webhook fonctionne

1. **Dans WordPress** :
   - Publiez un nouvel article
   - Vérifiez les logs WordPress (si activés)

2. **Dans Netlify** :
   - Allez dans **Deploys**
   - Vous devriez voir un nouveau build se déclencher automatiquement
   - Le build devrait avoir le titre "WordPress Content Update"

### Activer les logs WordPress (optionnel)

Ajoutez dans `wp-config.php` :

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Les logs seront dans `/wp-content/debug.log`

## ⚙️ Configuration Avancée

### Limiter les déclenchements

Si vous voulez limiter les builds (par exemple, seulement pour les articles publiés) :

```php
// Seulement pour les articles publiés
add_action('publish_post', 'trigger_netlify_build');

// Seulement pour certains types de posts
add_action('save_post', function($post_id) {
    $post = get_post($post_id);
    if ($post->post_type === 'post' && $post->post_status === 'publish') {
        trigger_netlify_build();
    }
});
```

### Ajouter un délai (debounce)

Pour éviter trop de builds si plusieurs articles sont modifiés rapidement :

```php
function trigger_netlify_build_debounced() {
    // Attendre 30 secondes avant de déclencher
    wp_schedule_single_event(time() + 30, 'netlify_build_hook');
}

add_action('netlify_build_hook', 'trigger_netlify_build');
add_action('publish_post', 'trigger_netlify_build_debounced');
```

## 📝 Notes Importantes

1. **Rate Limiting** : Netlify peut limiter le nombre de builds. Évitez de déclencher trop souvent.
2. **Build Time** : Chaque build prend du temps. Ne déclenchez pas à chaque modification mineure.
3. **Sécurité** : Le Build Hook URL est public mais unique. Ne le partagez pas publiquement.

## 🚀 Résultat Attendu

Une fois configuré :
- ✅ Publication d'article → Build Netlify automatique
- ✅ Modification d'article → Build Netlify automatique
- ✅ Suppression d'article → Build Netlify automatique
- ✅ Le site Netlify se met à jour automatiquement avec le nouveau contenu WordPress

## 🔗 Ressources

- [Netlify Build Hooks Documentation](https://docs.netlify.com/configure-builds/build-hooks/)
- [WordPress Hooks Reference](https://developer.wordpress.org/reference/hooks/)
- [WordPress HTTP API](https://developer.wordpress.org/plugins/http-api/)

