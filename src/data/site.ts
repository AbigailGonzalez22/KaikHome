// Company facts shown across the site. Edit here, not in the components.
export const site = {
  name: 'Kaik Home',
  url: 'https://www.kaikhome.com',
  phone: '+34 687 45 92 16',
  phoneHref: 'tel:+34687459216',
  email: 'comercial@kaikhome.com',
  address: {
    street: 'Puerta de la Fuente 13',
    postalCode: '45300',
    locality: 'Ocaña',
    region: 'Toledo',
  },
  social: {
    facebook: 'https://www.facebook.com/kaikhome/',
    instagram: 'https://www.instagram.com/kaikhome/',
  },
  gtm: 'GTM-WC5FL2PP',
} as const;

export const asuntos = [
  { value: 'Quiero comprar una vivienda', key: 'comprar', label: 'Comprar vivienda' },
  { value: 'Consulta sobre Bargas', key: 'bargas', label: 'Bargas' },
  { value: 'Consulta sobre Méntrida', key: 'mentrida', label: 'Méntrida' },
  { value: 'Otra consulta', key: 'otra', label: 'Otra consulta' },
] as const;
