import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//FilePond setup

import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

FilePond.registerPlugin(FilePondPluginImagePreview);

// Create FilePond instance
FilePond.create(document.querySelector('input[name="banner"]'));
FilePond.create(document.querySelector('input[name="image"]'));

// Trix editor setup
import 'trix';

