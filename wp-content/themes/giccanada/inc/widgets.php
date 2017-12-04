<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 10/2/17
 * Time: 3:28 PM
 */

/*
 * Класс OpenCaseWidget - Форма обратной связи
 * Виджет используется для отображения формы обратной связи.
 * Настраивается в админке.
 *
 * @see register_wp_sidebars
 */
class OpenCaseWidget extends WP_Widget {

	function __construct() {

	    require_once 'countries.php';
		$this->countries = getCountries();

		parent::__construct(
			'open-case-widget',
			'Open case form' // заголовок виджета
		);
	}

// Creating widget front-end
// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
        ?>
        <div id="open-case-form">
            <button class="close"><span>&times;</span></button>
            <form>
                <h2><?= $title; ?></h2>
<!--                <p>Оставьте свои контактные данные и мы свяжемся с Вами в ближайшее время</p>-->
                <p><?= $instance['phrase']; ?></p>
                <input type="text" name="first_name" id="last_name" placeholder="Ваше имя *" data-role="text" required>
                <span class="error-text" id="error-last_name"></span>
                <input type="tel" name="phone" id="phone" placeholder="Ваш телефон *" data-role="tel" required>
                <span class="error-text" id="error-phone"></span>
                <input type="email" name="email" id="email" placeholder="Ваш E-mail" data-role="email" required>
                <span class="error-text" id="error-email"></span>
                <div id="selection-block">
                    <select name="country" id="open-case-country" style="width: 100%" data-role="select" required>
						<?php foreach ($this->countries as $key => $value):?>
                            <option value="<?= $key; ?>"><?= $value;?></option>
						<?php endforeach;?>
                    </select>
                    <select name="lang" id="open-case-lang" style="width: 100%" required>
                        <option value="RU">Русский</option>
                        <option value="EN">Английский</option>
                        <option value="UA">Украинский</option>
                        <option value="AR">Арабский</option>
                    </select>
                </div>
                <span class="error-text" id="error-open-case-country"></span>
                <span class="error-text" id="error-open-case-form" style="visibility:hidden;"></span>
                <input type="submit" class="orange-btn" value="Отправить">
            </form>
        </div>
        <?php
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}
// Widget admin form
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>"
                   type="text"
                   value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'phrase' ); ?>"><?php _e( 'Text under title:' ); ?></label>
            <textarea class="widefat"
                   id="<?php echo $this->get_field_id( 'phrase' ); ?>"
                   name="<?php echo $this->get_field_name( 'phrase' ); ?>"><?php echo trim(esc_attr( $instance[ 'phrase' ] )); ?></textarea>
        </p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['phrase'] = ( ! empty( $new_instance['phrase'] ) ) ? strip_tags( $new_instance['phrase'] ) : '';
		return $instance;
	}
}
