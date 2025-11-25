# Elementor Blank Starter

Tema WordPress minimalista optimizado para Elementor con integración de Kirki Framework.

## Características

- ✅ 100% compatible con Elementor
- ✅ Kirki Framework integrado para personalización avanzada
- ✅ Estructura minimalista
- ✅ Theme Builder ready (header, footer, single, archive)
- ✅ Optimizado para rendimiento
- ✅ Responsive y mobile-first

## Instalación

### Opción 1: Clonar desde GitHub

1. En tu Mac, abre Terminal y navega a la carpeta de temas:
   ```bash
   cd '/Users/luis/Local Sites/blanc/app/public/wp-content/themes/'
   git clone https://github.com/luismallebrera/elementor-blank-starter.git
   ```

2. Activa el tema desde **Apariencia → Temas**

3. Instala el plugin Kirki:
   - Ve a **Plugins → Añadir nuevo**
   - Busca "Kirki Customizer Framework"
   - Instala y activa

### Opción 2: Descarga manual

1. Descarga el repositorio como ZIP
2. Descomprime en `wp-content/themes/`
3. Activa el tema
4. Instala el plugin Kirki desde **Plugins → Añadir nuevo**

## Requisitos

- WordPress 6.0 o superior
- PHP 7.4 o superior
- Elementor (gratuito o Pro)
- Plugin: Kirki Customizer Framework

## Kirki Framework

Este tema incluye Kirki Framework que proporciona:

- **Panel de Colores**: Personaliza colores primarios y secundarios
- **Tipografía**: Control completo sobre fuentes del cuerpo y encabezados
- **Layout**: Ajusta el ancho del contenedor
- **CSS Personalizado**: Añade tu propio CSS desde el Customizer

### Acceder al Customizer

Ve a **Apariencia → Personalizar → Theme Options**

## Uso con Elementor

1. Instala y activa Elementor
2. Ve a **Elementor → Theme Builder**
3. Crea tu:
   - Header Template
   - Footer Template
   - Single Post Template
   - Archive Template
4. Asigna los templates a las ubicaciones correspondientes

## Estructura de Archivos

```
elementor-blank-starter/
├── inc/
│   ├── kirki/              # Kirki Framework (instalado via Composer)
│   └── customizer.php      # Configuración de Kirki
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── single.php
├── scripts.js
├── style.css
├── composer.json
└── README.md
```

## Personalización

### Añadir nuevas opciones de Kirki

Edita `inc/customizer.php` para añadir más campos. Ejemplo:

```php
Kirki::add_field('elementor_blank_config', array(
    'type'     => 'color',
    'settings' => 'mi_color',
    'label'    => 'Mi Color Personalizado',
    'section'  => 'colors_section',
    'default'  => '#ffffff',
));
```

### Variables CSS disponibles

El tema genera estas variables CSS que puedes usar:

- `--primary-color`
- `--secondary-color`
- `--container-width`

## Soporte

Para reportar problemas o sugerir mejoras, abre un issue en:
https://github.com/luismallebrera/elementor-blank-starter/issues

## Licencia

GPL v2 or later

## Créditos

- [Elementor](https://elementor.com/)
- [Kirki Framework](https://github.com/themeum/kirki)
