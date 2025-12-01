import { getPermalink, getBlogPermalink } from '~/utils/permalinks';

export const headerData = {
  links: [
    {
      text: 'CitizenLab',
      links: [
        {
          text: 'A Propos',
          href: getPermalink('/a-propos'),
        },
        {
          text: 'Equipe',
          href: getPermalink('/equipe'),
        },
      ],
    },
    {
      text: 'Actualités',
      href: getBlogPermalink(),
      links: [

        {
          text: 'Campagnes',
          href: getPermalink('campagnes', 'category'),
        },
        {
          text: 'Podcasts',
          href: getPermalink('podcast', 'category'),
        },
        {
          text: 'Vidéos',
          href: getPermalink('videos', 'category'),
        },

      ],
    },
    {
      text: 'Blog',
      href: getPermalink('blog', 'category')
    },
    {
      text: 'Formations',
      href: getPermalink('formations', 'category')
    },
    {
      text: 'Contact',
      href: getPermalink('/contact'),
    },
    
  ],
};

export const footerData = {
  links: [
    {
      title: 'CitizenLab',
      links: [
        {
          text: 'A Propos', href: getPermalink('/a-propos') },
        { text: 'Equipe', href: getPermalink('/equipe') },
      ],
    },
    {
      title: 'Actualités',
      links: [
        { text: "Actualités", href: getBlogPermalink() },
        { text: "Blog", href: getPermalink('blog', 'category') },
        { text: 'Campagnes', href:'#' },
        { text: 'Podcasts', href: getPermalink('podcast', 'category') },
        { text: 'Vidéos', href: getPermalink('videos', 'category') },
        { text: 'Formations', href: getPermalink('formations', 'category') },
      ],
    },

    {
      title: "Nous Contacter",
      links:[
        { text: "citizenlabguinee@africtivistes.org", href:'mailto:citizenlabguinee@africtivistes.org ' },
        { text: "+224 623 456 789", href: 'tel:+224623456789'},
        {text: " Conakry, Guinée ", href: '#'}
      ]
    }
  ],
  secondaryLinks: [
    { text: 'Termes et Conditions', href: getPermalink('/termes-et-conditions') },
    //{ text: 'Privacy Policy', href: getPermalink('/privacy') },
  ],
  socialLinks: [
    { icon: 'tabler:brand-x', href: 'https://x.com/citizenlab_GN/status/1993635336145039807?s=20' },
    { icon: 'tabler:brand-linkedin', href: 'https://www.linkedin.com/feed/update/urn:li:activity:7399398552302465024/' },
    { icon: 'tabler:brand-facebook', href: 'https://www.facebook.com/AfricTivistesCitizenLabGuinnee/posts/pfbid0UTr2tkdyZQAVwQL3Uwv9TttrwcqXeFa2heaD9ESD2LiujyRry7uhMbS8rRDffjpQl?rdid=UIj26ft4ozV2wxlq#' },
    { icon: 'tabler:brand-instagram', href: 'https://www.instagram.com/p/DRhHYNVjJJZ/?igsh=NWE2bTMxMHo4amU%3D' },
    { icon: 'tabler:brand-github', href: 'https://github.com/AfricTivistes/CitizenLabGuinee' },
  ],
  footNote: `
  <a href="https://www.africtivistes.com" target= '_blank'>
  <img src="https://update.africtivistes.org/wp-content/uploads/2023/10/Logo-Africtivistes.png" alt="AfricTivistes" class="h-8" />
  </a>
    <a target= '_blank' class="text-green-600 hover:underline dark:text-gray-200" href="https://www.africtivistes.com"> AfricTivistes</a> · All rights reserved.
  `,
};
