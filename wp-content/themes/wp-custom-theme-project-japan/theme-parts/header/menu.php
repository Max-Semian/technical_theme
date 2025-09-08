<nav class="relative flex h-20 items-center justify-between">
	<div class="flex flex-1 items-center justify-between">
		<div class="flex items-center xl:flex-1">
			<?php get_template_part( 'theme-parts/logo' ); ?>
		</div>
		<div class="flex xl:!hidden">
			<button
				class="hamburger-btn inline-flex items-center justify-center rounded-lg text-gray-700 -m-2.5 p-2.5"
				type="button"
			>
				<span class="sr-only">Open main menu</span
				><svg
					class="h-8 w-8 text-white"
					fill="none"
					viewbox="0 0 24 24"
					stroke-width="1.5"
					stroke="currentColor"
					aria-hidden="true"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
					></path>
				</svg>
			</button>
		</div>
		<div class="hidden xl:!flex xl:gap-x-5">
			<?php
				wp_nav_menu( 
					array( 
						'theme_location' => 'header',
						'depth'          => 5,
						'container'      => null,
						'menu_class'     => 'hidden xl:!flex xl:gap-x-5',
						'walker'         => new Header_Walker_Nav_Menu(),
					) 
				); 
				?>
			<div class="dropdown group relative -mx-3 pt-2 lang-switcher xl:m-0 xl:py-1">
				<a 
					class="main-menu-link dropdown-toggle flex justify-between items-center gap-x-1 duration-200 font-bold text-sm w-auto uppercase hover:bg-transparent hover:text-grizzly" 
					href="#" 
					aria-expanded="false"
				>
					<svg 
						class="dropdown-arrow h-5 w-5 flex-none duration-200 xl:group-hover:rotate-180" 
						viewBox="0 0 20 20" 
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
					class="dropdown-menu absolute -left-2 top-full z-10 mt-0 w-max max-w-md overflow-hidden rounded-lg shadow-lg duration-200 opacity-0 group-hover:opacity-100 ring-1 invisible p-2 ring-gray-900/5 group-hover:visible"
				>
				</ul>
			</div>
		</div>
		<!-- Auth button -->
		<div class="hidden xl:!flex xl:flex-1 xl:justify-end">
			<?php get_template_part( 'theme-parts/header/auth-button' ); ?>
		</div>
	</div>
</nav>
