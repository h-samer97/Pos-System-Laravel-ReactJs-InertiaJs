import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
  title: (title) => (title ? `${title} - Laravel` : 'Laravel'),
  resolve: (name) => resolvePageComponent(`./Pages/${name}.tsx`, import.meta.glob('./Pages/**/*.tsx')),
  setup: ({ App, props }) => {
    const root = document.getElementById('app');

    if (!root) {
      return;
    }

    createRoot(root).render(<App {...props} />);
  },
});
