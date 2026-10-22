import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

// Each development is one JSON file in src/content/promociones/.
// The filename is its URL: bargas.json -> /bargas.
const promociones = defineCollection({
  loader: glob({ pattern: '*.json', base: './src/content/promociones' }),
  schema: ({ image }) =>
    z.object({
      orden: z.number(),
      nombre: z.string(),
      localidad: z.string(),
      provincia: z.string().default('Toledo'),
      estado: z.string(),
      // Color of the status dot and badge: 'clay' (obra en curso) or 'green' (en ejecución).
      estadoColor: z.enum(['clay', 'green']),
      viviendas: z.number(),
      plantas: z.string(),
      obraEjecutada: z.number().min(0).max(100).optional(),
      entrega: z.string(),
      // The four facts in the hero bar. icono: plantas | ubicacion | obra | entrega | viviendas
      stats: z.array(z.object({ icono: z.enum(['plantas', 'ubicacion', 'obra', 'entrega', 'viviendas']), texto: z.string() })),
      titular: z.string(),
      descripcion: z.string(),
      resumen: z.string(),
      dossier: z.string(),
      hero: image(),
      heroAlt: z.string(),
      portada: image(),
      portadaAlt: z.string(),
      contacto: z.object({ titulo: z.string(), texto: z.string() }),
      tipologias: z.array(
        z.object({
          id: z.string(),
          nombre: z.string(),
          imagen: image(),
          imagenAlt: z.string(),
          construidos: z.number(),
          patios: z.number(),
          dormitorios: z.number(),
          banos: z.number(),
          rasgos: z.array(z.string()),
          planos: z.array(z.object({ imagen: image(), alt: z.string() })),
        }),
      ),
      seo: z.object({
        title: z.string(),
        description: z.string(),
        ogTitle: z.string(),
        ogDescription: z.string(),
      }),
    }),
});

const proximas = defineCollection({
  loader: glob({ pattern: '*.json', base: './src/content/proximas' }),
  schema: ({ image }) =>
    z.object({
      orden: z.number(),
      titulo: z.string(),
      localidad: z.string(),
      imagen: image(),
      imagenAlt: z.string(),
    }),
});

export const collections = { promociones, proximas };
