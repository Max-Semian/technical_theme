const closeElements = document.querySelectorAll<HTMLDivElement>(".close-menu");
const hamburgerBtn = document.querySelectorAll<HTMLButtonElement>(".hamburger-btn");
const mobileMenu = document.querySelector<HTMLDivElement>("#mobile-menu");

closeElements.forEach((el) => {
	el.addEventListener("click", () => {
		mobileMenu?.classList.toggle("hidden");
		document.body.classList.toggle("overflow-y-hidden");
	});
});

hamburgerBtn.forEach((btn) => {
	btn.addEventListener("click", () => {
		mobileMenu?.classList.toggle("hidden");
		document.body.classList.toggle("overflow-y-hidden");
	});
});
