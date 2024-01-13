<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'filter_admin' => \App\Filters\Filter_Admin::class,
		'filter_pemilik' => \App\Filters\Filter_Pemilik::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'filter_admin' => ['except' => [
				'auth', 'auth/*',
			]],
			'filter_pemilik' => ['except' => [
				'auth', 'auth/*',
			]],

			//'honeypot',
			// 'login'
			// 'csrf',
		],
		'after'  => [
			'filter_admin' => ['except' => [
				'home', 'home/*',
				'produk', 'produk/*',
				'cabang', 'cabang/*',
				'jenis_produk', 'jenis_produk/*',
				'motif_produk', 'motif_produk/*',
				'stok_produk', 'stok_produk/*',
				'mutation', 'mutation/*',
				'laporan_admin', 'laporan_admin/*',
				'laporan_pemilik', 'cetak_laporan/*',
				'user', 'user/*',
				'profile', 'profile/*',
			]],
			'filter_pemilik' => ['except' => [
				'pemilik', 'pemilik/*',
				'laporan_pemilik', 'laporan_pemilik/*',
				'laporan_pemilik', 'cetak_laporan/*',
				'profile', 'profile/*',
			]],
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [
		'login' => ['before' => ['admin']]
	];
}
