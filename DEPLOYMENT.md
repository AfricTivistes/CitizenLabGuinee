# 🚀 Guide de Déploiement - CitizenLab Guinée

## Configuration Netlify

### 1. Variables d'environnement à configurer

Dans votre dashboard Netlify, configurez les variables d'environnement suivantes :

```bash
# GraphQL Configuration
GRAPHQL_ENDPOINT=https://citizenlab.africtivistes.org/citizenlabguinee/graphql
GRAPHQL_DEBUG=false

# WordPress Configuration
WP_SITE_URL=https://citizenlab.africtivistes.org/citizenlabguinee
WP_ADMIN_URL=https://citizenlab.africtivistes.org/citizenlabguinee/wp-admin

# Site Configuration
SITE_NAME=AfricTivistes CitizenLab Guinée
SITE_URL=https://citizenlabguinee.netlify.app

# Build Configuration
NODE_ENV=production
ASTRO_ENV=production

# Analytics
GOOGLE_ANALYTICS_ID=G-TT2H971V99
```

### 2. Configuration du build

- **Build command** : `npm run build`
- **Publish directory** : `dist`
- **Node version** : `18`

### 3. Déploiement automatique

1. Connectez votre repository GitHub à Netlify
2. Configurez les variables d'environnement ci-dessus
3. Déployez automatiquement à chaque push sur la branche `main`

### 4. Déploiement manuel

```bash
# Installation des dépendances
npm install

# Build pour la production
npm run build

# Déploiement sur Netlify
netlify deploy --prod --dir=dist
```

## 🔗 Liens utiles

- **Site de production** : https://citizenlabguinee.netlify.app
- **GraphQL Endpoint** : https://citizenlab.africtivistes.org/citizenlabguinee/graphql
- **WordPress Admin** : https://citizenlab.africtivistes.org/citizenlabguinee/wp-admin

## 📧 Contact

- **Email** : citizenlabguinee@africtivistes.org
- **Téléphone** : +224 623 456 789
- **Adresse** : Conakry, Guinée

## 🌐 Réseaux sociaux

- **Twitter** : https://twitter.com/GuineeCitizenlab
- **Instagram** : https://www.instagram.com/citizenlabguinee/
- **Facebook** : https://www.facebook.com/profile.php?id=61553614994312
- **LinkedIn** : https://www.linkedin.com/company/citizen-lab-guinee/about/
- **GitHub** : https://github.com/AfricTivistes/CitizenLabGuinee 