import { baseBreakpoints } from "./constants";

const throttle = (func: (...args: unknown[]) => void, timeout: number) => {
	let ready: boolean = true;

	return (...args: unknown[]) => {
		if (!ready) {
			return;
		}

		ready = false;
		func(...args);

		setTimeout(() => (ready = true), timeout);
	};
};

const showOnPx = 100;
const invisibleClasses = ["invisible", "opacity-0"];

const backToTopButton = document.querySelector<HTMLButtonElement>("#back-to-top");
const fixedButton = document.querySelector<HTMLDivElement>("#fixed-button");

const getScrollContainer = () => document.documentElement || document.body;

const handleVisibleFixedButton = (isVisible: boolean) => {
	if (isVisible) {
		fixedButton?.classList.remove(...invisibleClasses);
	} else {
		fixedButton?.classList.add(...invisibleClasses);
	}
};

if (backToTopButton || fixedButton) {
	document.addEventListener(
		"scroll",
		() => {
			const scrollContainer = getScrollContainer();

			if (scrollContainer.scrollTop > showOnPx) {
				backToTopButton?.classList.remove(...invisibleClasses);
			} else {
				backToTopButton?.classList.add(...invisibleClasses);
			}

			handleVisibleFixedButton(
				scrollContainer.scrollTop > showOnPx && window.innerWidth < baseBreakpoints.lg
			);
		},
		{ capture: true, passive: true }
	);

	if (fixedButton) {
		const breakpoint = window.matchMedia(`(min-width:${baseBreakpoints.lg}px)`);

		const breakpointChecker = () => {
			const scrollContainer = getScrollContainer();

			handleVisibleFixedButton(!breakpoint.matches && scrollContainer.scrollTop > showOnPx);
		};

		breakpoint.onchange = breakpointChecker;
	}

	if (backToTopButton) {
		const orientation = window.matchMedia("(orientation: portrait)");

		const setBottomPositionForBackToTopButton = () => {
			backToTopButton.style.bottom = "2rem";
			document.body.style.paddingBottom = null;

			if (fixedButton && window.innerWidth < baseBreakpoints.lg) {
				const fixedButtonHeight = fixedButton.clientHeight;

				document.body.style.paddingBottom = `${fixedButtonHeight}px`;
				backToTopButton.style.bottom = `${fixedButtonHeight + 20}px`;
			}
		};

		setBottomPositionForBackToTopButton();

		orientation.addEventListener("change", throttle(setBottomPositionForBackToTopButton, 100), {
			passive: true,
		});
		window.addEventListener("resize", throttle(setBottomPositionForBackToTopButton, 100), {
			passive: true,
		});
	}
}

backToTopButton?.addEventListener("click", () => {
	document.body.scrollIntoView({
		behavior: "smooth",
	});
});
