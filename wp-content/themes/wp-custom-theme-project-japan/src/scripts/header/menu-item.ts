import { baseBreakpoints } from "../constants";

const dropdownMenuItems = document.querySelectorAll<HTMLDivElement>(".dropdown");

dropdownMenuItems.forEach((item) => {
	const link = item.querySelector("a.dropdown-toggle");
	const dropdownMenu = item.querySelector(".dropdown-menu");
	const dropdownArrow = item.querySelector(".dropdown-arrow");

	link?.addEventListener("click", (e) => {
		e.preventDefault();

		const currentWindowWidth = window.innerWidth;

		if (currentWindowWidth < baseBreakpoints.xl) {
			dropdownArrow?.classList.toggle("rotate-180");

			dropdownMenu?.classList.toggle("hidden");
		}
	});
});
