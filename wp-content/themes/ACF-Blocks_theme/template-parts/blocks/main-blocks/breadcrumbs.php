<!-- template-parts/blocks/elements-block/breadcrumbs.php -->
<?php 
    if (!is_front_page()) {
    ?>
    <section>
    <div class="container" style="border: none !important; background: transparent !important">
    <div class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
        <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a class="home-breadcrumbs" itemprop="item" href="/">
                <svg width="24" height="8" viewBox="0 0 24 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_172_2154)">
                <path d="M23 4.50034C23.2761 4.50034 23.5 4.27648 23.5 4.00034C23.5 3.7242 23.2761 3.50034 23 3.50034V4.50034ZM0.646447 3.64679C0.451184 3.84205 0.451184 4.15863 0.646447 4.35389L3.82843 7.53587C4.02369 7.73114 4.34027 7.73114 4.53553 7.53587C4.7308 7.34061 4.7308 7.02403 4.53553 6.82877L1.70711 4.00034L4.53553 1.17191C4.7308 0.976651 4.7308 0.660068 4.53553 0.464806C4.34027 0.269544 4.02369 0.269544 3.82843 0.464806L0.646447 3.64679ZM23 3.50034H1V4.50034H23V3.50034Z" fill="#2D3746" fill-opacity="0.44"/>
                </g>
                <defs>
                <clipPath id="clip0_172_2154">
                <rect width="24" height="8" fill="white"/>
                </clipPath>
                </defs>
                </svg>
            <span itemprop="name">Главная</span>
            </a>
            <meta itemprop="position" content="1" />
        </div>
        <span class="breadcrumb-separator"> - </span>
        <div itemprop="itemListElement" class="last-breadcrumb" itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name"><?php echo get_the_title(); ?></span>
            <meta itemprop="position" content="2" />
        </div>
     </div>
     </div>
    </section>
 <?php }?>