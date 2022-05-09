import Cookie from './cookie';
import { Modal, Utils } from 'bootstrap';


window.addEventListener('DOMContentLoaded', (event) => {
	let popupIndex = 0;
	const popups = document.querySelectorAll('.otomaties-bootstrap-popup');

	if (popups.length > 0) {
		showPopup();
	}

	function showPopup() {
		const popup = popups[popupIndex];
		popupIndex++;

		const modal = new Modal(popup);
		
		const hash = popup.getAttribute('data-hash');
		const delay = popup.getAttribute('data-delay');
		const show_once = popup.getAttribute('data-show-once');
		const saw_popup = popup.getAttribute('data-saw-popup');

		let cookie = new Cookie("saw_popup_" + hash)
		cookie.set(hash)

		if (!show_once || !saw_popup) {
			window.setTimeout(function(){
				modal.show();
				if (popupIndex < popups.length) {
					popup.addEventListener('hidden.bs.modal', function (event) {
						showPopup();
					});
				}
			}, delay);
		}
	}
});
