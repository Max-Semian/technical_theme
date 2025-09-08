const form = document.querySelector<HTMLFormElement>("#subscribe-form");

form?.addEventListener("submit", (event) => {
	event.preventDefault();
	form.reset();
});
