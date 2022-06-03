import { Modal, Utils } from 'bootstrap';
import showPopups from './show-popup';

window.addEventListener('DOMContentLoaded', (event) => {
	const popups = document.querySelectorAll('.otomaties-bootstrap-popup');

	if (popups.length > 0) {
		showPopups(popups, 0, Modal);
	}
});
