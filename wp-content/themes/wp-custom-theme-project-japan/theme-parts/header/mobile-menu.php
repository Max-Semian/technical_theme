<div class="mobile-menu hidden absolute xl:!hidden" id="mobile-menu" role="dialog" aria-modal="true">
	<div class="close-menu fixed inset-0 z-10 bg-dark-opacity"></div>
	<div
		class="fixed mobile-menu-wrapper inset-y-0 right-0 z-10 flex flex-col w-full overflow-y-auto px-4 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
	>
		<div class="flex items-center justify-between">
			<div class="sm:hidden">
				<?php get_template_part( 'theme-parts/logo' ); ?>
			</div>
			<div class="lang-switcher relative group py-1">
				<a
					class="main-menu-link dropdown-toggle mobile-exclude flex items-center gap-x-1 text-sm font-bold duration-200"
					href="#"
					aria-expanded="false"
				>
					<svg
						class="dropdown-arrow h-5 w-5 flex-none duration-200 group-hover:rotate-180"
						viewbox="0 0 20 20"
						fill="currentColor"
						aria-hidden="true"
					>
						<path
							fill-rule="evenodd"
							d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
							clip-rule="evenodd"
						></path>
					</svg>
				</a>
				<ul
					class="dropdown-menu dropdown-menu-lang mobile-exclude absolute -left-2 top-full z-10 mt-0 w-max max-w-md overflow-hidden rounded-lg shadow-lg ring-1 p-2 invisible ring-gray-900/5 duration-200 opacity-0 group-hover:opacity-100 group-hover:visible"
				></ul>
			</div>
			<button class="close-menu rounded-md text-white -m-2.5 p-2.5" type="button">
				<span class="sr-only">Close menu</span>
				<svg
					class="h-6 w-6"
					fill="none"
					viewbox="0 0 24 24"
					stroke-width="1.5"
					stroke="currentColor"
					aria-hidden="true"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M6 18L18 6M6 6l12 12"
					></path>
				</svg>
			</button>
		</div>
		<div class="flow-root grow">
			<div class="flex flex-col h-full justify-between">
				<?php
					wp_nav_menu( 
						array( 
							'theme_location' => 'header',
							'depth'          => 5,
							'container'      => null,
							'menu_class'     => 'space-y-2 py-6 divide-y divide-dark-grizzly',
							'walker'         => new Header_Walker_Nav_Menu(),
						) 
					); 
					?>
				<!-- Auth button -->
				<div class="mx-auto">
					<?php get_template_part( 'theme-parts/header/auth-button' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
