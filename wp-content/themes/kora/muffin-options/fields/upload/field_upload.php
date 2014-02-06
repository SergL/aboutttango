<?php
class MFN_Options_upload extends MFN_Options{	
	
	
	/**
	 * Field Constructor.
	*/
	function __construct( $field = array(), $value ='', $parent = NULL ){
		if( is_object($parent) ) parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;		
	}

	
	/**
	 * Field Render Function.
	*/
	function render( $meta = false ){
		
		$class = ( isset($this->field['class']) ) ? $this->field['class'] : 'regular-text';
		$name = ( ! $meta ) ? ( $this->args['opt_name'].'['.$this->field['id'].']' ) : $this->field['id'];
		
		echo '<input type="hidden" name="'. $name .'" value="'.$this->value.'" class="'.$class.'" />';
		echo '<img class="mfn-opts-screenshot" src="'.$this->value.'" />';

		if($this->value == ''){$remove = ' style="display:none;"';$upload = '';}else{$remove = '';$upload = ' style="display:none;"';}
		echo ' <a href="javascript:void(0);" class="mfn-opts-upload"'.$upload.' ><span></span>'.__('Browse', 'mfn-opts').'</a>';
		echo ' <a href="javascript:void(0);" class="mfn-opts-upload-remove"'.$remove.'>'.__('Remove Upload', 'mfn-opts').'</a>';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><span class="description">'.$this->field['desc'].'</span>':'';
		
	}

	
	/**
	 * Enqueue Function.
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'mfn-opts-field-upload-js', 
			MFN_OPTIONS_URI.'fields/upload/field_upload.js', 
			array('jquery', 'thickbox', 'media-upload'),
			time(),
			true
		);
		
		wp_enqueue_style('thickbox');
		wp_localize_script('mfn-opts-field-upload-js', 'mfn_upload', array('url' => $this->url.'fields/upload/blank.png'));
		
	}
	
	
}
?>