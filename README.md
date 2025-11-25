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

### Paso 1: Clonar o descargar el tema

En tu Mac, abre Terminal y ejecuta:
```bash
cd '/Users/luis/Local Sites/blanc/app/public/wp-content/themes/'
git clone https://github.com/luismallebrera/elementor-blank-starter.git
```

### Paso 2: Incluir Kirki en el tema

1. Descarga el plugin Kirki desde: https://wordpress.org/plugins/kirki/
2. Descomprime el archivo ZIP
3. Copia la carpeta `kirki` dentro de:
   ```
   wp-content/themes/elementor-blank-starter/inc/kirki-plugin/
   ```

La estructura debe quedar así:
```
elementor-blank-starter/
├── inc/
│   └── kirki-plugin/
│       └── kirki.php  (archivo principal del plugin)
├── functions.php
└── ...
```

### Paso 3: Activar el tema

Ve a **Apariencia → Temas** y activa "Elementor Blank Starter"

## Requisitos

- WordPress 6.0 o superior
- PHP 7.4 o superior
- Elementor (gratuito o Pro)
- Composer (para instalar Kirki)

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
