<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/about">About</a>
        </li>
        
        <li>
            <a href="<?php echo URLROOT; ?>/pages/contact">Contact</a>
        </li>

        
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>

                
                    <a href="<?php echo URLROOT; ?>/Profile/index">Profile</a>
                

                <li>
                    <a href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
                </li>

            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>

            <?php endif; ?>
        </li>
    </ul>
</nav>
