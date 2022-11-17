import showPopups from './show-popup';

window.addEventListener('BootstrapLoaded', (event) => {
	const popups = document.querySelectorAll('.otomaties-bootstrap-popup');
	if (popups.length > 0) {
		showPopups(popups, 0, event.detail.components.modal);
	}
});
