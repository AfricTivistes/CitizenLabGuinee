<?php
/**
 * Plugin WordPress pour déclencher automatiquement les builds Netlify
 * 
 * Installation :
 * 1. Copiez ce fichier dans /wp-content/plugins/netlify-build-hook/
 * 2. Activez le plugin dans WordPress
 * 3. Configurez l'URL du Build Hook dans les paramètres
 */

if (!defined('ABSPATH')) {
    exit;
}

class NetlifyBuildHook {
    private $build_hook_url = 'https://api.netlify.com/build_hooks/6925c9bcd4a1d9211ea592d1';
    
    public function __construct() {
        // Hooks pour les articles
        add_action('publish_post', array($this, 'trigger_build'), 10, 2);
        add_action('save_post', array($this, 'trigger_build_on_save'), 10, 2);
        add_action('delete_post', array($this, 'trigger_build'));
        
        // Hooks pour les pages
        add_action('publish_page', array($this, 'trigger_build'), 10, 2);
        add_action('save_page', array($this, 'trigger_build_on_save'), 10, 2);
        
        // Hook pour les commentaires approuvés
        add_action('wp_set_comment_status', array($this, 'trigger_build_on_comment'), 10, 2);
        
        // Menu d'administration (optionnel)
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }
    
    /**
     * Déclencher le build Netlify
     */
    public function trigger_build($post_id = null, $post = null) {
        // Éviter les builds multiples pour le même événement
        if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
            return;
        }
        
        $response = wp_remote_post($this->build_hook_url, array(
            'method' => 'POST',
            'timeout' => 30,
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode(array(
                'trigger_title' => 'WordPress Content Update',
                'triggered_by' => 'WordPress',
                'post_id' => $post_id,
            )),
        ));
        
        // Log pour le débogage
        if (is_wp_error($response)) {
            error_log('Netlify Build Hook Error: ' . $response->get_error_message());
        } else {
            $response_code = wp_remote_retrieve_response_code($response);
            if ($response_code === 200 || $response_code === 201) {
                error_log('Netlify Build Hook Success: Build triggered successfully');
            } else {
                error_log('Netlify Build Hook Warning: Response code ' . $response_code);
            }
        }
    }
    
    /**
     * Déclencher le build seulement si le post est publié
     */
    public function trigger_build_on_save($post_id, $post) {
        if ($post->post_status === 'publish') {
            $this->trigger_build($post_id, $post);
        }
    }
    
    /**
     * Déclencher le build quand un commentaire est approuvé
     */
    public function trigger_build_on_comment($comment_id, $status) {
        if ($status === 'approve') {
            $this->trigger_build();
        }
    }
    
    /**
     * Ajouter un menu d'administration (optionnel)
     */
    public function add_admin_menu() {
        add_options_page(
            'Netlify Build Hook',
            'Netlify Build',
            'manage_options',
            'netlify-build-hook',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Page d'administration
     */
    public function admin_page() {
        if (isset($_POST['trigger_build']) && check_admin_referer('netlify_build_trigger')) {
            $this->trigger_build();
            echo '<div class="notice notice-success"><p>Build Netlify déclenché avec succès!</p></div>';
        }
        ?>
        <div class="wrap">
            <h1>Netlify Build Hook</h1>
            <p>URL du Build Hook : <code><?php echo esc_html($this->build_hook_url); ?></code></p>
            <form method="post">
                <?php wp_nonce_field('netlify_build_trigger'); ?>
                <p>
                    <input type="submit" name="trigger_build" class="button button-primary" value="Déclencher un Build Maintenant" />
                </p>
            </form>
            <p><em>Le build se déclenche automatiquement lors de la publication/modification d'articles.</em></p>
        </div>
        <?php
    }
}

// Initialiser le plugin
new NetlifyBuildHook();


