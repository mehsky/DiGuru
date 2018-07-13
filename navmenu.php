<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/main" class="navbar-brand">DiGuru</a>
            </div>
            <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if ($page == 'find_training.php') { ?>class="active"<?php } ?>><a href="/find_training">Find Training</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li <?php if ($page == 'customized_training.php') { ?>class="active"<?php } ?>><a href="/customized_training">Customized Training</a></li>
                            <li <?php if ($page == 'referral_program.php') { ?>class="active"<?php } ?>><a href="/referral_program">Referral Program</a></li>
                            <li <?php if ($page == 'volume-pricing.php') { ?>class="active"<?php } ?>><a href="/volume-pricing">Volume Pricing</a></li>
                            <li <?php if ($page == 'certification.php') { ?>class="active"<?php } ?>><a href="/certification">Certification</a></li>
                        </ul>
                    </li>
                    <li <?php if ($page == 'resource_center.php') { ?>class="active"<?php } ?>><a href="/resource_center">Resource Center</a></li>
                    <li <?php if ($page == 'why_us.php') { ?>class="active"<?php } ?>><a href="/why_us">Why Us</a></li>
                    <li <?php if ($page == 'who_we_are.php') { ?>class="active"<?php } ?>><a href="/who_we_are">Who we are</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   <li><a href="#login" data-toggle="modal">My DiGuru</a></li>
                </ul>
            </div>
        </div>

        
    </nav>
    <br />
    <br />
    <br />