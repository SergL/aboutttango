<?php
function wpp_maxab_log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

function wpp_maxab_build_conversion_tracking_script($conversion_url) {
	$tracking_url = WPPMAXAB_PLUGIN_URL_PLUGIN_URL . '/includes/conversion-elsewhere.php?url=' . $conversion_url;
	return '<script type="text/javascript" src="' . $tracking_url . '"></script>';
}

function wpp_maxab_string_ends_with($string, $end) {
	$strlen = strlen($string);
	$endlen = strlen($end);
	
	if ($endlen > $strlen) {
		return false;
	}
	
	// Notice the use of the === operator
	return (substr_compare($string, $end, -$endlen) === 0);
}

function wpp_maxab_get_url() {
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
	$url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // does not work with query string
	//$url .= $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"],'?'); // removes query string, used wpp_maxab_get_url_without_querystring() instead


	
	return $url;
}

function wpp_maxab_get_url_without_querystring() {
	$url = wpp_maxab_get_url();
	
	if (wpp_maxab_url_contains($url, '?')) {
		return substr($url, 0, strpos($url, '?'));
	}
	
	return $url;
}

function wpp_maxab_url_contains($url, $string) {
	// Notice the use of the === operator
	if (strpos($url, $string) === false) {
		return false;
	}
	
	return true;
}

function wpp_maxab_redirect($url) {
	header('Location: ' . $url);
    exit();
}

function wpp_maxab_calculate_conversion_rate($conversion_visitors, $total_visitors) {
	if ($total_visitors == 0) { return 0; }
	return ($conversion_visitors / $total_visitors);
}

function wpp_maxab_calculate_original_conversion_rate($experiment) {
	return wpp_maxab_calculate_conversion_rate($experiment->conversion_visitors_from_original, $experiment->original_visitors);
}

function wpp_maxab_calculate_variation1_conversion_rate($experiment) {
	return wpp_maxab_calculate_conversion_rate($experiment->conversion_visitors_from_variation1, $experiment->variation1_visitors);
}

function wpp_maxab_calculate_variation2_conversion_rate($experiment) {
	return wpp_maxab_calculate_conversion_rate($experiment->conversion_visitors_from_variation2, $experiment->variation2_visitors);
}

function wpp_maxab_calculate_variation3_conversion_rate($experiment) {
	return wpp_maxab_calculate_conversion_rate($experiment->conversion_visitors_from_variation3, $experiment->variation3_visitors);
}

function wpp_maxab_calculate_improvement($original_rate, $variation_rate) {
	if ($original_rate == 0) { return 0; }
	return (($variation_rate / $original_rate) - 1);
}

function wpp_maxab_calculate_variation1_improvement($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	$variation1_rate = wpp_maxab_calculate_variation1_conversion_rate($experiment);
	return wpp_maxab_calculate_improvement($original_rate, $variation1_rate);
}

function wpp_maxab_calculate_variation2_improvement($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	$variation2_rate = wpp_maxab_calculate_variation2_conversion_rate($experiment);
	return wpp_maxab_calculate_improvement($original_rate, $variation2_rate);
}

function wpp_maxab_calculate_variation3_improvement($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	$variation3_rate = wpp_maxab_calculate_variation3_conversion_rate($experiment);
	return wpp_maxab_calculate_improvement($original_rate, $variation3_rate);
}

function wpp_maxab_calculate_standard_error($rate, $visitors) {
	if ($visitors == 0) { return 0; }
	return sqrt(($rate * (1 - $rate) / $visitors));
}

function wpp_maxab_calculate_original_standard_error($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	return wpp_maxab_calculate_standard_error($original_rate, $experiment->original_visitors);
}

function wpp_maxab_calculate_variation1_standard_error($experiment) {
	$variation1_rate = wpp_maxab_calculate_variation1_conversion_rate($experiment);
	return wpp_maxab_calculate_standard_error($variation1_rate, $experiment->variation1_visitors);
}

function wpp_maxab_calculate_variation2_standard_error($experiment) {
	$variation2_rate = wpp_maxab_calculate_variation2_conversion_rate($experiment);
	return wpp_maxab_calculate_standard_error($variation2_rate, $experiment->variation2_visitors);
}

function wpp_maxab_calculate_variation3_standard_error($experiment) {
	$variation3_rate = wpp_maxab_calculate_variation3_conversion_rate($experiment);
	return wpp_maxab_calculate_standard_error($variation3_rate, $experiment->variation3_visitors);
}

function wpp_maxab_calculate_z_score($original_rate, $original_standard_error, $variation_rate, $variation_standard_error) {
	$base = sqrt(pow($original_standard_error, 2) + pow($variation_standard_error, 2));
	if ($base == 0) { return 0; }
	return ($original_rate - $variation_rate)/$base;
}

function wpp_maxab_calculate_variation1_z_score($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	$original_std_err = wpp_maxab_calculate_original_standard_error($experiment);
	$variation1_rate = wpp_maxab_calculate_variation1_conversion_rate($experiment);
	$variation1_std_err = wpp_maxab_calculate_variation1_standard_error($experiment);
	
	return wpp_maxab_calculate_z_score($original_rate, $original_std_err, $variation1_rate, $variation1_std_err);
}

function wpp_maxab_calculate_variation2_z_score($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	$original_std_err = wpp_maxab_calculate_original_standard_error($experiment);
	$variation2_rate = wpp_maxab_calculate_variation2_conversion_rate($experiment);
	$variation2_std_err = wpp_maxab_calculate_variation2_standard_error($experiment);
	
	return wpp_maxab_calculate_z_score($original_rate, $original_std_err, $variation2_rate, $variation2_std_err);
}

function wpp_maxab_calculate_variation3_z_score($experiment) {
	$original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
	$original_std_err = wpp_maxab_calculate_original_standard_error($experiment);
	$variation3_rate = wpp_maxab_calculate_variation3_conversion_rate($experiment);
	$variation3_std_err = wpp_maxab_calculate_variation3_standard_error($experiment);
	
	return wpp_maxab_calculate_z_score($original_rate, $original_std_err, $variation3_rate, $variation3_std_err);
}

function wpp_maxab_is_p_value_statistically_significant($p_value) {
	if ($p_value > 0.5) {
		$p_value = 1 - $p_value;
	}
	
	$p_value = round($p_value * 1000) / 1000;
	
	if ($p_value < 0.025) {
		return true;
	}
	else {
		return false;
	}
}

function wpp_maxab_calculate_statistical_confidence($p_value) {
	if ($p_value < 0.5) {
		$p_value = $p_value - 1;
	}
	
	return abs($p_value);
}

function wpp_maxab_display_statistical_confidence($p_value) {
	$val = wpp_maxab_calculate_statistical_confidence($p_value) * 100;
	return number_format($val, 1) . '%';
}

function wpp_maxab_has_p_value_reached_95_percent_confidence($p_value) {
	return ($p_value < 0.05 || $p_value > 0.95) ? true : false;
}

function wpp_maxab_has_p_value_reached_99_percent_confidence($p_value) {
	return ($p_value < 0.01 || $p_value > 0.99) ? true : false;
}

function wpp_maxab_display_original_conversion_rate($experiment) {
	if (($experiment->original_id != 0) && ($experiment->original_url != '')) {
		$rate = wpp_maxab_calculate_original_conversion_rate($experiment) * 100;
		return number_format($rate, 1) . '%';
	}
	return 'Нет';
}

function wpp_maxab_display_variation1_conversion_rate($experiment) {
	if (($experiment->variation1_id != 0) && ($experiment->variation1_url != '')) {
		$rate = wpp_maxab_calculate_variation1_conversion_rate($experiment) * 100;
		return number_format($rate, 1) . '%';
	}
	return 'Нет';
}

function wpp_maxab_display_variation2_conversion_rate($experiment) {
	if (($experiment->variation2_id != 0) && ($experiment->variation2_url != '')) {
		$rate = wpp_maxab_calculate_variation2_conversion_rate($experiment) * 100;
		return number_format($rate, 1) . '%';
	}
	return 'Нет';
}

function wpp_maxab_display_variation3_conversion_rate($experiment) {
	if (($experiment->variation3_id != 0) && ($experiment->variation3_url != '')) {
		$rate = wpp_maxab_calculate_variation3_conversion_rate($experiment) * 100;
		return number_format($rate, 1) . '%';
	}
	return 'Нет';
}

function wpp_maxab_display_variation1_improvement($experiment) {
	if (($experiment->variation1_id != 0) && ($experiment->variation1_url != '')) {
		$improvement = wpp_maxab_calculate_variation1_improvement($experiment) * 100;
		return number_format($improvement, 1) . '%';
	}
	return 'Нет';
}

function wpp_maxab_display_variation2_improvement($experiment) {
	if (($experiment->variation2_id != 0) && ($experiment->variation2_url != '')) {
		$improvement = wpp_maxab_calculate_variation2_improvement($experiment) * 100;
		return number_format($improvement, 1) . '%';
	}
	return 'Нет';
}

function wpp_maxab_display_variation3_improvement($experiment) {
	if (($experiment->variation3_id != 0) && ($experiment->variation3_url != '')) {
		$improvement = wpp_maxab_calculate_variation3_improvement($experiment) * 100;
		return number_format($improvement, 1) . '%';
	}
	return 'Нет';
}

/*
This functions below were taken from the PHPExcel project (http://phpexcel.codeplex.com/).
I would've just used the entire library as-is, but that would've added about 11MB to the
size of the plugin (zipped), all for only a couple functions. Functions have been renamed
to match the naming convention used in this plugin and some minor refactorings were used.
*/

define('WPP_PRECISION', 8.88E-016);
define('WPP_SQRT2PI', 2.5066282746310005024157652848110452530069867406099);

function wpp_maxab_flatten_single_value($value = '') {
	while (is_array($value)) {
		$value = array_pop($value);
	}
	return $value;
}

function wpp_maxab_calculate_erfc($x) {
	$x = wpp_maxab_flatten_single_value($x);

	if (is_numeric($x)) {
		if ($x < 0) {
			return '#NUM!';
		}
		return wpp_maxab_calculate_erfc_value($x);
	}
	return '#VALUE!';
}

function wpp_maxab_calculate_erfc_value($x) {
	$_one_sqrtpi = 0.564189583547756287;
	
	if (abs($x) < 2.2) {
		return 1 - wpp_maxab_calculate_erf_value($x);
	}
	if ($x < 0) {
		return 2 - wpp_maxab_calculate_erfc(-$x);
	}
	$a = $n = 1;
	$b = $c = $x;
	$d = ($x * $x) + 0.5;
	$q1 = $q2 = $b / $d;
	$t = 0;
	do {
		$t = $a * $n + $b * $x;
		$a = $b;
		$b = $t;
		$t = $c * $n + $d * $x;
		$c = $d;
		$d = $t;
		$n += 0.5;
		$q1 = $q2;
		$q2 = $b / $d;
	} while ((abs($q1 - $q2) / $q2) > PRECISION);
	return $_one_sqrtpi * exp(-$x * $x) * $q2;
}

function wpp_maxab_calculate_erf_value($x) {
	$_two_sqrtpi = 1.128379167095512574;
	
	if (abs($x) > 2.2) {
		return 1 - wpp_maxab_calculate_erfc_value($x);
	}
	$sum = $term = $x;
	$xsqr = ($x * $x);
	$j = 1;
	do {
		$term *= $xsqr / $j;
		$sum -= $term / (2 * $j + 1);
		++$j;
		$term *= $xsqr / $j;
		$sum += $term / (2 * $j + 1);
		++$j;
		if ($sum == 0.0) {
			break;
		}
	} while (abs($term / $sum) > WPP_PRECISION);
	return $_two_sqrtpi * $sum;
}

/*
 * Returns the normal distribution for the specified mean and standard deviation.
 *
 * @param	float		$value
 * @param	float		$mean		Mean Value
 * @param	float		$stdDev		Standard Deviation
 * @param	boolean		$cumulative
 * @return	float
 */
function wpp_maxab_calculate_normal_distribution($value, $mean, $stdDev, $cumulative) {
	$value = wpp_maxab_flatten_single_value($value);
	$mean = wpp_maxab_flatten_single_value($mean);
	$stdDev = wpp_maxab_flatten_single_value($stdDev);

	if ((is_numeric($value)) && (is_numeric($mean)) && (is_numeric($stdDev))) {
		if ($stdDev < 0) {
			return '#NUM!';
		}
		if ((is_numeric($cumulative)) || (is_bool($cumulative))) {
			if ($cumulative) {
				return 0.5 * (1 + wpp_maxab_calculate_erf_value(($value - $mean) / ($stdDev * sqrt(2))));
			} else {
				return (1 / (WPP_SQRT2PI * $stdDev)) * exp(0 - (pow($value - $mean,2) / (2 * ($stdDev * $stdDev))));
			}
		}
	}
	return '#VALUE!';
}
