<?php
	/*
		Version: 			0.9.4
		WebSite: 		http://eteon.airzox.com
		Licensed:		AirZox Technologies
		License-key:		KJXS-NMAL-004D-V15A
		Developed by: 	Aleksander Haugas (Eteon MVC)
		
		Copyright (C) 2021, AirZox All rights reserved.
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
	*/

    return array(
        // index.php
        'Cache' => 'Caché',
        'Should cache' => 'Deben caché',

        // views/index.php
        'Smart Cache' => 'Smart Cache',
        'Cached pages' => 'Páginas en caché',
        'Clear all' => 'Borrar todo',

        // views/documentation.php
        'Smart Cache - Example rewrite rules' => 'Smart Cache - Reglas de reescritura de ejemplo',
        'Introduction' => 'Introducción',
        'The Smart Cache plugin works by using mod_rewrite or equivalent rewrite functionality. Below you will find generated examples for the most used HTTP servers.' => 'El plugin de Smart Cache funciona utilizando mod_rewrite o funcionalidad de reescritura equivalente. A continuación encontrará ejemplos generados por los servidores HTTP más utilizados.',
        'Please be aware the author of this plugin cannot guarantee the accuracy of these examples and does not know all rewrite systems.' => '
Tenga en cuenta que el autor de este plugin no puede garantizar la exactitud de estos ejemplos y no sabe todos los sistemas de reescritura.',
        'Always check the plugin settings after enabling it!' => '¡Siempre revise la configuración del plugin después de lo que le!',
        'If you have translated the rewrite rules to another platform, please let the maintainer of this plugin know.' => 'Si ha traducido las reglas de reescritura a otra plataforma, por favor, deje que el mantenedor de este plugin sabe.',

        // views/settings.php
        'Smart Cache Plugin' => 'Smart Cache Plugin',
        'Cache settings' => 'Configuración de caché',
        'Cache by default' => 'Caché de forma predeterminada',
        'Yes' => 'Sí',
        'No' => 'No',
        'Choose yes if you want your pages to be cached by default. Otherwise you must set caching for each page manually.' => 'Elija Sí si desea que sus páginas estén en caché de forma predeterminada. De lo contrario, debe configurar el almacenamiento en caché para cada página de forma manual.',
        'Cache file suffix' => 'Sufijo de archivo de caché',
        'Suffix for cache files written to disk. If you use other than .html you also need to update your mod_rewrite rules.' => 'Sufijo para los archivos de caché escritos en el disco. Si utiliza distinta. HTML también es necesario actualizar las reglas de mod_rewrite.',
        'Cache folder' => 'Directorio de caché',
        'Folder where static cache files are written. Relative to document root. When you change this you also need to update your mod_rewrite rules.' => 'Directorio donde los archivos caché estáticas son escritas. Relativo a la raíz del documento. Al cambiar esto, también debe actualizar las reglas mod_rewrite.',
        'Save' => 'Guardar',

        // views/sidebar.php
        'Example rewrite rules' => 'Reglas de reescritura de ejemplo',
        'Settings' => 'Configuración',
        'About Smart Cache' => 'Sobre Smart Cache',
        'The Smart Cache plugin allows you to cache pages on the filesystem. It works by using mod_rewrite or equivalent rewrite functionality.' => 'El plugin de Smart Cache permite almacenar en caché las páginas del sistema de archivos. Funciona mediante el uso de mod_rewrite o funcionalidad de reescritura equivalente.',
        'Homepage' => 'Página principal',

        // SmartCacheController.php
        'Page was deleted from cache.' => 'La página ha sido eliminada de la memoria caché.',
        'The cached page could not be deleted. Try manually from the commandline.' => 'La página en caché no pudo ser eliminado. Pruebe manualmente desde la línea de comandos.',
        'Cache cleared successfully.' => 'Caché borrado correctamente.',
        'One or more cached pages could not be deleted. Try manually from the commandline.' => 'Uno o más páginas en caché no se pudo eliminar. Pruebe manualmente desde la línea de comandos.',
        'The cache settings have been updated.' => 'La configuración de caché se han actualizado.',
        'The cache settings could not be updated due to an error.' => 'Los valores de memoria caché no podían ser actualizados debido a un error.',

    );
