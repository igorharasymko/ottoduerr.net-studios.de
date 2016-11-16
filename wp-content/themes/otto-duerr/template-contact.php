<?php
/*
Template Name: Contact Page
*/
get_header(); ?>
<?php 
global $timthumb,$kaya_readmore;
$sidebar_layout=get_post_meta($post->ID,'kaya_pagesidebar',true); 
//sidebar class
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
?>
</div>
</div>
<!--Start Middle Section  -->

<div id="content_wrapper">
    <!--Start content_wrapper -->
    <div id="content">
        <?php
	// Page Title
	echo custom_pagetitle($post->ID);
?>
        <div <?php echo page_layout($post->ID); ?>>
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Apogee' ), 'after' => '</div>' ) ); ?>
                </div>
                <!-- .entry-content -->
            </div>
            <!-- #post-## -->
            <?php endwhile; ?>
            <h2>Kontakt</h2>
            <h3>Sie haben Fragen? Nehmen Sie direkt Kontakt zu uns auf.</h3>
                <?php
        // wenn das Formular übermittelt wurde
        $mailnachricht = "";
        if(isset($_POST['submit'])){
            while(list($feld,$wert)=each($_POST)){
                // übermittelte Inhalte "entschärfen"
                $wert=preg_replace("/(content-type:|bcc:|cc:|to:|from:)/im", "",$wert);
                   $$feld=$wert;
                // die übermittelten Variablen werden zum "Text der Email" zusammengefasst
                if($feld!="submit"){
                    $mailnachricht.=ucfirst($feld).": $wert\n";
                }
            }
            $mailnachricht.="\nDatum/Zeit: ". date("d.m.Y H:i:s");
            // Überprüfen ob alle Pflichtfelder gefüllt sind
            empty($fullname) ? $err[] = "<p class='text'>- <strong>Bitte geben Sie Ihren Namen an.</strong></p>" : false;
            empty($email) ? $err[] = "<p class='text'>- <strong>Bitte geben Sie Ihre Email-Adresse an.</strong></p>" : false; 
            empty($message) ? $err[] = "<p class='text'>- <strong>Welchen Wunsch haben Sie? Bitte geben Sie einen Text ein.</strong></p>" : false; 
			empty($subject) ? $err[] = "<p class='text'>- <strong>Welchen Betreff hat Ihr Anliegen?</strong></p><br>" : false; 

            // wenn nicht, werden die Fehlermeldungen ausgegeben und das "halbgefüllte" Formular angezeigt
            if(!empty($err)) {
                echo "<p><span id='error-headline'>Bitte korrigieren Sie folgende Fehler:</span></p>";
                foreach($err as $fehler){
                    echo $fehler;
                } ?>

        <?php    // sind keine Fehler vorhanden, wird die Email versendet
            } else {
                $mailbetreff="Kontaktformular Otto Duerr";
                // HIER DIE EMPFÄNGER EMAIL-ADRESSE ANPASSEN!!!        
                if(mail(get_option('admin_email'), $mailbetreff, $mailnachricht)){
                    echo "<p class='text'>Vielen Dank für Ihre E-Mail!</p>";
                } else {
                    echo "<p class='text'>Ein Fehler ist aufgetreten!</p>";
                }
            }
        // das Formular welches als erstes dem Besucher angezeigt wird
        } else	{
		echo'<form action="" method="post" id="contact-form">
				
					<p id="formstatus"></p> 
					<div>
						<label for="name">'.__('Ihr Name', 'Acens').': <span class="require">*</span></label><input type="text" value="" name="fullname" id="fullname" class="text"/>
					</div> 
					<div>
						<label for="email">'.__('Ihre Email-Adresse','Acens').': <span class="require">*</span></label><br/><input type="text" value="" name="email" id="email" class="text">
					</div> 
					<div>
						<label for="subject">'.__('Betreff','Acens').': <span class="require">*</span></label><br/><input type="text" value="" name="subject" id="subject" class="text">
					</div> 
					<div>
						<label for="message">'.__('Nachricht', 'Acens').': </label><br/><textarea cols="25" rows="3" name="message" id="message"></textarea>
					</div>
					<div>
						<input type="submit" value="'.__('Senden', 'Acens').'" name="submit" id="kaya_submit"><br/>
					</div>
				
			</form>'; 
		} ?></div>
        <!--StartSidebar Section -->
        <?php if($sidebar_layout !="full") { ?>
        <div class="<?php echo $aside_class;?>">
            <?php get_sidebar();?>
        </div>
        <div class="clear"></div>
        <?php } ?>
        <div class="clear"></div>
  
    </div>
    <!--End content Section -->
</div>
<!--End Middle ( #content_wrapper ) Section -->
<?php get_footer(); ?>