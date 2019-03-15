<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area post-cmts">


	<div class="prod-comment-form post-form">
		<h3><?php esc_html_e('Add your comment', 'allstore'); ?></h3>
		<?php
		$commenter = wp_get_current_commenter();
		$html_req = ( $req ? " required='required'" : '' );
		$html5    = 'html5';
		comment_form( array(
			'title_reply_before' => '',
			'title_reply_after'  => '',
			'title_reply'          => '',
			'fields' => array(
				'author' => '<input placeholder="'.__('Name', 'allstore').'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" maxlength="245"' . $html_req . ' />',
				'email'  => '<input placeholder="'.__('E-mail', 'allstore').'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" maxlength="100"' . $html_req  . ' />',
				'url' => '',
			),
			'comment_field'        => '<textarea placeholder="'.__('Enter your comment here..', 'allstore').'" id="comment" name="comment" maxlength="65525" required="required"></textarea>',
			'comment_notes_before' => '',

			'class_form' => 'post-addcomment',
			'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s <i class="fa fa-angle-right"></i></button>',
			'label_submit'         => esc_html__( 'Send', 'allstore' ),
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
				/* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
					__( '<a class="logged-in-as-profile" href="%1$s" aria-label="%2$s">%3$s</a> (<a href="%4$s">Log out?</a>)', 'allstore' ),
					get_edit_user_link(),
					/* translators: %s: user name */
					esc_attr( sprintf( esc_html__( '%s. Edit your profile.', 'allstore' ), $user_identity ) ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) )
				) . '</p>',
		) );
		?>
	</div>

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<ul class="comment-list reviews-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'avatar_size' => 80,
				'callback'    => 'allstore_comment',
			) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<?php
			paginate_comments_links( array(
				'prev_text'    => '<i class="fa fa-angle-left"></i> '.esc_html__('Prev', 'allstore'),
				'next_text'    => esc_html__('Next', 'allstore').' <i class="fa fa-angle-right"></i>',
				'type'      => 'list',
			) );
			?>
		<?php endif; // Check for have_comments(). ?>

		<?php
	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'allstore' ); ?></p>
		<?php
	endif;
	?>

</div><!-- #comments -->
