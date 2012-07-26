<?php
/*
Template Name: Front Page
*/

get_header(); ?>

<!-- Portfolio -->

  <div class="row" id="portfolio">

    <div class="span12" id="portfolio-slider">

      <div class="carousel slide">
        <!-- Carousel items -->
        <div class="carousel-inner">

          <?php
            $uploads = wp_upload_dir();
            $url = $uploads['baseurl'] . '/front-page-portfolio/';
            $iterator = new DirectoryIterator($uploads['basedir'] . '/front-page-portfolio/');

            $hasActiveAdded = false;

            foreach ($iterator as $fileinfo) {
              if ($fileinfo->isFile()) {

                if ($hasActiveAdded == false) {
                  $active = ' active';
                  $hasActiveAdded = true;
                } else {
                  $active = '';
                }

                echo '<div class="item' . $active .'"><img src="' . $url . $fileinfo->getFilename() . '" /></div>';
              }
            }

          ?>
        </div>
      </div>
    </div>

  </div>

</div> <!-- Zamyka div.container z header.php -->

<div class="content-wide">
  <div class="container">
    <div class="row" id="sesja-portretowa">
      <div class="span12">
        <h2>Sesja Portretowa</h2>
      </div>
    </div>
    <div class="row" >
      <div class="span6">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus lectus, aliquam ut volutpat quis, porttitor porttitor purus. Etiam vel justo tortor. Etiam vel tellus massa, ac ultricies urna. Aliquam vitae purus lacus, ac fermentum sapien. Vivamus in mi augue, vitae auctor diam. Suspendisse quis elit nibh, at dignissim ipsum. Pellentesque sagittis bibendum dolor, non egestas leo sagittis id. In libero nibh, varius sed dictum a, faucibus non orci. Duis tempus vehicula massa, in congue risus aliquam sollicitudin. Nulla gravida, erat volutpat accumsan viverra, nibh purus suscipit dolor, in tincidunt dui eros ut turpis. Donec sed metus et quam pulvinar feugiat eget et leo. Integer dignissim neque ut dui viverra vel condimentum dui sagittis. Praesent leo neque, interdum vel ornare et, volutpat eu metus. Nullam vestibulum quam in augue cursus venenatis. Nam augue sem, iaculis vitae dapibus lacinia, ullamcorper vitae lectus. Ut aliquet semper diam vitae faucibus.</p>

        <p>Etiam mollis ullamcorper risus id commodo. Pellentesque tempus diam in tellus euismod condimentum consectetur tortor fermentum. Maecenas quis eros faucibus nibh dictum congue ac ornare urna. Donec egestas nisi sed mi varius vel aliquet quam viverra. Etiam nibh nisi, tincidunt id congue quis, scelerisque et neque. Sed nunc lorem, convallis vitae elementum eu, adipiscing non turpis. Cras ac porttitor purus. Aliquam et urna vitae orci viverra imperdiet. Vivamus pretium odio varius nisi pharetra fringilla. Integer adipiscing pulvinar fermentum.</p>

        <p>Sed sagittis dignissim sapien, vitae porta felis luctus a. Curabitur nec sapien id magna hendrerit fringilla. Donec et dolor at tellus porttitor rhoncus et non lorem. Aliquam condimentum, leo sed gravida feugiat, mi arcu adipiscing augue, non cursus nisi urna a neque. Nulla facilisi. Praesent interdum placerat tincidunt. Morbi consectetur volutpat ipsum, non imperdiet elit rutrum at. Nunc tempor elit tempor risus semper euismod. Integer interdum mollis sodales. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris molestie laoreet nunc, nec viverra sapien imperdiet et. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec vulputate pellentesque turpis, eget porta magna egestas at.</p>
      </div>

      <div class="span6">

        <p>Cras orci est, vestibulum vel ultrices vitae, condimentum et metus. Sed eu ultrices augue. Sed hendrerit faucibus justo, luctus hendrerit mi volutpat et. Pellentesque interdum tempor sapien, vel adipiscing dui imperdiet non. Pellentesque aliquet, erat a pretium fringilla, turpis est euismod diam, eu adipiscing turpis nisi et tellus. Phasellus tempor varius massa eu egestas. Cras quis pulvinar lacus. Ut quis erat lacus, eget consequat turpis. Fusce pellentesque ipsum in odio aliquam adipiscing a a urn.</p>

        <p>Fusce quis arcu augue. Nulla in dolor id orci pellentesque venenatis sodales vitae velit. Aenean nec magna enim, sit amet viverra massa. Vivamus volutpat rhoncus sagittis. Fusce id turpis a neque posuere iaculis. Nam sit amet sapien vel sapien tempor vehicula ut in tortor. Phasellus ac elit id nunc viverra sagittis. Curabitur condimentum nulla sed nibh iaculis eget sollicitudin lorem aliquet. Fusce ipsum lectus, ullamcorper et placerat at, luctus mollis diam. Nullam facilisis luctus justo nec faucibus. Suspendisse ullamcorper sem et felis gravida interdum.</p>

        <p>Fusce quis arcu augue. Nulla in dolor id orci pellentesque venenatis sodales vitae velit. Aenean nec magna enim, sit amet viverra massa. Vivamus volutpat rhoncus sagittis. Fusce id turpis a neque posuere iaculis. Nam sit amet sapien vel sapien tempor vehicula ut in tortor. Phasellus ac elit id nunc viverra sagittis. Curabitur condimentum nulla sed nibh iaculis eget sollicitudin lorem aliquet. Fusce ipsum lectus, ullamcorper et placerat at, luctus mollis diam. Nullam facilisis luctus justo nec faucibus. Suspendisse ullamcorper sem et felis gravida interdum.</p>
      </div>
    </div>
  </div>
</div>

<div class="container content">
  <div class="row" id="blog">
    <div class="span12">
blog
    </div>
  </div>
</div>

<div class="content-wide">
  <div class="container">
    <div class="row" id="robert">
      <div class="span12">
        <h2>Robert Raszczyński</h2>
      </div>
    </div>
    <div class="row">
      <div class="span6">
        <img src="<?php bloginfo('template_url'); ?>/img/robert.jpg">
      </div>

      <div class="span6">
        <p>Fusce quis arcu augue. Nulla in dolor id orci pellentesque venenatis sodales vitae velit. Aenean nec magna enim, sit amet viverra massa. Vivamus volutpat rhoncus sagittis. Fusce id turpis a neque posuere iaculis. Nam sit amet sapien vel sapien tempor vehicula ut in tortor. Phasellus ac elit id nunc viverra sagittis. Curabitur condimentum nulla sed nibh iaculis eget sollicitudin lorem aliquet. Fusce ipsum lectus, ullamcorper et placerat at, luctus mollis diam. Nullam facilisis luctus justo nec faucibus. Suspendisse ullamcorper sem et felis gravida interdum.</p>

        <p>Fusce quis arcu augue. Nulla in dolor id orci pellentesque venenatis sodales vitae velit. Aenean nec magna enim, sit amet viverra massa. Vivamus volutpat rhoncus sagittis. Fusce id turpis a neque posuere iaculis. Nam sit amet sapien vel sapien tempor vehicula ut in tortor. Phasellus ac elit id nunc viverra sagittis. Curabitur condimentum nulla sed nibh iaculis eget sollicitudin lorem aliquet. Fusce ipsum lectus, ullamcorper et placerat at, luctus mollis diam. Nullam facilisis luctus justo nec faucibus. Suspendisse ullamcorper sem et felis gravida interdum.</p>
      </div>
    </div>
  </div>
</div>

<div class="container content">
  <div class="row" id="kontakt">
    <div class="span12">
kontakt
    </div>
  </div>
</div>

<div class="container content">
<?php get_footer(); ?>