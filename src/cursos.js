function syncCursosCollapseByViewport() {
	const collapseItems = document.querySelectorAll('.cursos__list.collapse[id]');

	if (!collapseItems.length) return;

	const desktopMedia = window.matchMedia('(min-width: 992px)');
	const isDesktop = desktopMedia.matches;

	collapseItems.forEach((item) => {
		const trigger = document.querySelector(`a[data-bs-toggle="collapse"][href="#${item.id}"]`);

		item.classList.toggle('show', isDesktop);
		item.style.height = '';

		if (trigger) {
			trigger.classList.toggle('collapsed', !isDesktop);
			trigger.setAttribute('aria-expanded', isDesktop ? 'true' : 'false');
		}
	});
}

document.addEventListener('DOMContentLoaded', syncCursosCollapseByViewport);
// Debounced Resize
let timer;
window.addEventListener("resize", () => {
	clearTimeout(timer);
	timer = setTimeout(() => {
		console.log("Resize handler triggered", window.innerWidth);
		syncCursosCollapseByViewport();
	}, 500);
});
