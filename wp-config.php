<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
if ($_SERVER["HTTP_HOST"] == '192.168.3.11') {
    define('DB_NAME', '592xy.cn');

    /** MySQL数据库用户名 */
    define('DB_USER', '592xy.cn');

    /** MySQL数据库密码 */
    define('DB_PASSWORD', '9Hthq9iXG3yFGS5MCzgqYeyIzJZQOdvVu8OmL-ufVBkpKaronL');
}
else {
    define('DB_NAME', 'wordpress');

    /** MySQL数据库用户名 */
    define('DB_USER', 'wordpress');

    /** MySQL数据库密码 */
    define('DB_PASSWORD', 'yoSxS99V90');
}

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Qf`Uejm&P,F;rEJlB40]R]E)&>udLoHkf9ifc8j_9Y~N-2_B=UpLUM?kl5]41yny');
define('SECURE_AUTH_KEY',  'S$-t:*-!y9T~xO!06n_>0+MjTV+m2=dBnf_:-{)#g>zkfT9a>Z^v/_~UxLin`gX7');
define('LOGGED_IN_KEY',    'G@cL5@u?;*QQN/cp&F&2t|+M/43U>A].jU?3D-.v|M0QYfW|Y,!V`{g.|6jE:cUk');
define('NONCE_KEY',        'm0?_!r|^m>zqP={z{!cb6n(@f0~oxf2Z?7 |QK@[rFwp_n*(eH++z(xrL~r +41U');
define('AUTH_SALT',        'Lj>r>oU!l**S+G+EGP3*%a/AKkSXD-op1$a9.CST_Y1,lz%~6?-sFw^|>Fa1X_ww');
define('SECURE_AUTH_SALT', '+Jl8|+a6uK<[VPMZSGy/y7%]TO;Q5(:):~z4=Xgna)cYiGj%jZv#PeF,mS`Bc@;Q');
define('LOGGED_IN_SALT',   'p@x(=)U#mQ(5-]1<LjyZpx(`P7=5-v7FV|#%8q+Y*t p28w8G|8-PlRoOShd0eiK');
define('NONCE_SALT',       'QQ1*>z*F6wJ#E4Q4L1gz.{,:6[l-}1SVb`m/U:)G:SI=)[),l8.j-{J,|[-[l`{P');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', true);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');