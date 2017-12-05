	<!-- Template Name: Products main 0 -->

<!-- // pm0 -->
<!-- // Page for main category. -->

<?php get_header(); ?>

<div class='prod-tocatalogs'>
	<a href='<?php echo home_url();?>/catalogs/'>Click here to view our catalogs.</a>
	<div class='prod-tocatalogs-underline'>
	</div>
</div>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			global $wp_query;
			global $wpdb;
			$p0m0 = $wp_query->query_vars['m0'];
			$main_category = $wpdb->get_results("SELECT DISTINCT m0 From wp_prod0;");
			// $main_category2 = $main_category;
			echo "<table id='product-main-page'>";
			echo "<td class='cat-bar'>";	// This is accordion section.
			echo "<h4><a href='../'>PRODUCT CATEGORIES</a></h4>";
			foreach($main_category as $main_category) {
				$s1_category = $wpdb->get_results("SELECT DISTINCT s1 FROM wp_prod0 WHERE m0 = '$main_category->m0';");
				if(!empty($s1_category[0]->s1)){
					// echo "<div>";
					echo "<div class='custaccordion'><img class='chev' src='http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png'>&nbsp".$main_category->m0."</div>";
					echo "<div class='custpanel'>";
					foreach($s1_category as $s1_category) {
						$s2_category = $wpdb->get_results("SELECT DISTINCT s2 FROM wp_prod0 WHERE s1 = '$s1_category->s1';");
						if(!empty($s2_category[0]->s2)){
							echo "<div class='custaccordion'><img class='chev' src='http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png'>&nbsp".$s1_category->s1."</div>";
							echo "<div class='custpanel'>";
							foreach($s2_category as $s2_category) {
								echo "<div class='custaccordion no-sub'><a class='no-sub' href='../ps2/?m0=".$main_category->m0."&s1=".$s1_category->s1."&s2=".$s2_category->s2."'>".$s2_category->s2."</a></div>";
							}
							echo "</div>";  // end panel
						} else {
							echo "<div class='custaccordion'><a class='no-sub' href='../ps2/?m0=".$main_category->m0."&s1=".$s1_category->s1."&s2=".$s2_category->s2."'>".$s1_category->s1."</a></div>";
						}
					}
					echo "</div>";  // end panel.
				}
				else {
					echo "<div class='custaccordion'>".$main_category->m0."</div>";
				}
				// echo "<hr/>";
				// echo "</div>";
			}
			echo "</td>";		// This end accordion section.

			echo "<td class='prod-display'>";	// Start product section.

			// echo "<h1> HELLO </h1>";
			// $mPos = 0;
			echo "<div class='group-container'>";
			echo "<div class='m-title'>".$p0m0."</div>";
			$s1_category2 = $wpdb->get_results("SELECT DISTINCT s1 FROM wp_prod0 WHERE m0 = '$p0m0';");
			// print_r($s1_category2);
			if(!empty($s1_category2[0]->s1)) {
				echo "<div class='s1-box-background'>";
				echo "<div class='s1-box-flex-container'>";
				$counter = 0;
				foreach($s1_category2 as $s1_category2) {
					$img = $wpdb->get_results("SELECT DISTINCT cat1img FROM wp_prodlegend WHERE m0 = '$p0m0' AND s1 = '$s1_category2->s1' AND cat1img IS NOT NULL;");
					// print_r(sizeof($img));
					$s2_check = $wpdb->get_results("SELECT DISTINCT s2 FROM wp_prod0 WHERE m0='$p0m0' AND s1='$s1_category2->s1';");
					if((sizeof($s2_check)>=1) && (($s2_check[0]->s2)!="")){  //if s2 is not empty, go to ps1 page. else, go to ps2.
						echo "<a href='../ps1/?m0=".$p0m0."&s1=".$s1_category2->s1."' class='s1-box'>";
					} else {
						echo "<a href='../ps2/?m0=".$p0m0."&s1=".$s1_category2->s1."' class='s1-box'>";
					}
					echo "<div class='item-img'>";
					if (sizeof($img) > 1) {
						// foreach($img as $img) {
						//   echo "<img src='' height='100' width='100'>";
						// }
						echo "<img src='".$img[0]->cat1img."' height='100' width='100'>";

					} elseif (sizeof($img)===1) {
						// print_r($img->img0);
						echo "<img src='".$img[0]->cat1img."' height='100' width='100'>";
					} else {
						echo "<img src='http://files.coda.com.s3.amazonaws.com/imgv2/comingsoon.jpg' height='100' width='100'>";
					};
					// echo "<img src='https://s3.amazonaws.com/files.coda.com/content/prod/categories/193-brandedcableties.jpg' height='100' widht='100'>";
					echo "</div>";
					echo "<div class='s1-cat'>".$s1_category2->s1."</div>";
					echo "</a>";
					$counter++;
				}
				for($k=$counter; $k%4!=0; $k++){
					echo "<a class='s1-box s1-box-filler'></a>";
				}
				echo "</div>";	// end s1-box-flex-container
				echo "</div>";	// end s1-box-background
				}
				// $mPos++;
				echo "</div>";  //end group-container div;
			echo "</td>";
			echo "</table>";
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
