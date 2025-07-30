import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//FilePond setup File Drag and Drop

import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

FilePond.registerPlugin(FilePondPluginImagePreview);
// Expose globally
window.FilePond = FilePond;


// Trix editor setup Text Editor
import 'trix';

