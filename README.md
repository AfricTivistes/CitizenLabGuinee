# CitizenLab Guinée 🇬🇳

Plateforme de participation citoyenne développée par AfricTivistes pour la Guinée.

## 🚀 Déploiement sur Netlify

### Configuration des variables d'environnement

Dans votre dashboard Netlify, configurez les variables d'environnement suivantes :

```bash
GRAPHQL_ENDPOINT=https://citizenlab.africtivistes.org/citizenlabguinee/graphql
SITE_NAME=AfricTivistes CitizenLab Guinée
SITE_URL=https://citizenlabguinee.netlify.app
WP_SITE_URL=https://citizenlab.africtivistes.org/citizenlabguinee
WP_ADMIN_URL=https://citizenlab.africtivistes.org/citizenlabguinee/wp-admin
GRAPHQL_DEBUG=false
NODE_ENV=production
```

### Déploiement automatique

1. Connectez votre repository GitHub à Netlify
2. Configurez les paramètres de build :
   - **Build command** : `npm run build`
   - **Publish directory** : `dist`
   - **Node version** : `18`

### Déploiement manuel

```bash
# Installation des dépendances
npm install

# Build pour la production
npm run build

# Déploiement sur Netlify
netlify deploy --prod --dir=dist
```

## 🛠️ Développement local

```bash
# Installation des dépendances
npm install

# Démarrage du serveur de développement
npm run dev

# Build pour la production
npm run build

# Prévisualisation du build
npm run preview
```

## 📁 Structure du projet

```
src/
├── assets/
│   ├── images/
│   │   ├── guineedrapeau.svg    # Drapeau guinéen
│   │   └── ACLGuinee.png        # Logo ACL Guinée
│   └── styles/
├── components/
│   ├── widgets/                  # Composants de widgets
│   ├── ui/                      # Composants UI
│   └── blog/                    # Composants blog
├── content/                     # Contenu markdown
├── layouts/                     # Layouts Astro
├── pages/                       # Pages du site
└── utils/                       # Utilitaires
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

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE.md](LICENSE.md) pour plus de détails.
