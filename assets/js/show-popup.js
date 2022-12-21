import Cookie from './cookie';

export default function showPopups(popups, popupIndex, bootstrapModal) {
	const popup = popups[popupIndex];
	popupIndex++;

	const modal = new bootstrapModal(popup);

	const hash = popup.getAttribute('data-hash');
	const delay = popup.getAttribute('data-delay');
	const showOnce = Boolean(Number(popup.getAttribute('data-show-once')));
	const cookie = new Cookie('saw_popup');
	const cookieContent = cookie.get() != '' ? JSON.parse(cookie.get()) : [];
	const sawPopup = cookieContent.includes(hash);

	if(!sawPopup) {
		cookieContent.push(hash);
		cookie.set(JSON.stringify(cookieContent));
	}

	if (!showOnce || !sawPopup) {
		window.setTimeout(function () {
			modal.show();
			if (popupIndex < popups.length) {
				popup.addEventListener('hidden.bs.modal', function showNextPopup(event) {
					showPopups(popups, popupIndex, bootstrapModal);
					this.removeEventListener('hidden.bs.modal', showNextPopup);
				});
			}
		}, delay);
	} else {
		if (popupIndex < popups.length) {
			showPopups(popups, popupIndex, bootstrapModal);
		}
	}
}
