<?php

use TypiCMS\Models\User;

class MenuSeeder extends Seeder {

	public function run()
	{
		
		DB::table('menus')->delete();
		DB::table('menus_translations')->delete();
		DB::table('menulinks')->delete();
		DB::table('menulinks_translations')->delete();

		// `typicms`.`typi_menulinks`
		$typi_menulinks = array(
		  array('id' => '1','menu_id' => '1','page_id' => '1','parent' => '0','position' => '1','target' => '','module_name' => '','restricted_to' => '','class' => '','link_type' => '','created_at' => '2013-09-03 22:08:05','updated_at' => '2013-10-05 19:31:13'),
		  array('id' => '2','menu_id' => '1','page_id' => '2','parent' => '0','position' => '5','target' => '','module_name' => '','restricted_to' => '','class' => 'menu-contact','link_type' => '','created_at' => '2013-09-03 22:08:35','updated_at' => '2013-10-05 19:31:13'),
		  array('id' => '16','menu_id' => '1','page_id' => '29','parent' => '0','position' => '2','target' => '_blank','module_name' => 'poi','restricted_to' => '','class' => '','link_type' => '','created_at' => '2013-09-09 23:18:49','updated_at' => '2013-10-05 19:31:13'),
		  array('id' => '17','menu_id' => '1','page_id' => '0','parent' => '0','position' => '3','target' => '','module_name' => 'events','restricted_to' => '','class' => '','link_type' => '','created_at' => '2013-10-05 19:30:30','updated_at' => '2013-10-05 19:31:51'),
		  array('id' => '18','menu_id' => '1','page_id' => '0','parent' => '0','position' => '4','target' => '','module_name' => 'projects','restricted_to' => '','class' => '','link_type' => '','created_at' => '2013-10-05 19:31:09','updated_at' => '2013-10-05 19:31:51')
		);

		// `typicms`.`typi_menulinks_translations`
		$typi_menulinks_translations = array(
		  array('id' => '1','menulink_id' => '1','lang' => 'fr','status' => '1','title' => 'Accueil','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '2','menulink_id' => '1','lang' => 'nl','status' => '1','title' => 'Home','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '3','menulink_id' => '1','lang' => 'en','status' => '1','title' => 'Home','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '4','menulink_id' => '2','lang' => 'fr','status' => '1','title' => 'Contact','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '5','menulink_id' => '2','lang' => 'nl','status' => '1','title' => 'Contact','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '6','menulink_id' => '2','lang' => 'en','status' => '1','title' => 'Contact','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '46','menulink_id' => '16','lang' => 'fr','status' => '1','title' => 'Infos','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '47','menulink_id' => '16','lang' => 'nl','status' => '1','title' => 'Info','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '48','menulink_id' => '16','lang' => 'en','status' => '1','title' => 'Info','url' => '','uri' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
		  array('id' => '49','menulink_id' => '17','lang' => 'fr','status' => '1','title' => 'Événements','url' => '','uri' => 'fr/evenements','created_at' => '2013-10-05 19:30:30','updated_at' => '2013-10-05 19:30:32'),
		  array('id' => '50','menulink_id' => '17','lang' => 'nl','status' => '1','title' => 'Evenementen','url' => '','uri' => 'nl/evenementen','created_at' => '2013-10-05 19:30:30','updated_at' => '2013-10-05 19:31:48'),
		  array('id' => '51','menulink_id' => '17','lang' => 'en','status' => '1','title' => 'Events','url' => '','uri' => 'en/events','created_at' => '2013-10-05 19:30:30','updated_at' => '2013-10-05 19:31:51'),
		  array('id' => '52','menulink_id' => '18','lang' => 'fr','status' => '1','title' => 'Projets','url' => '','uri' => 'fr/projets','created_at' => '2013-10-05 19:31:09','updated_at' => '2013-10-05 19:31:11'),
		  array('id' => '53','menulink_id' => '18','lang' => 'nl','status' => '1','title' => 'Projecten','url' => '','uri' => 'nl/projecten','created_at' => '2013-10-05 19:31:09','updated_at' => '2013-10-05 19:31:49'),
		  array('id' => '54','menulink_id' => '18','lang' => 'en','status' => '1','title' => 'Projects','url' => '','uri' => 'en/projects','created_at' => '2013-10-05 19:31:09','updated_at' => '2013-10-05 19:31:51')
		);

		// `typicms`.`typi_menus`
		$typi_menus = array(
		  array('id' => '1','name' => 'main','created_at' => '2013-09-03 22:05:21','updated_at' => '2013-09-03 22:05:21'),
		  array('id' => '2','name' => 'footer','created_at' => '2013-09-03 22:05:42','updated_at' => '2013-09-03 22:05:42')
		);

		// `typicms`.`typi_menus_translations`
		$typi_menus_translations = array(
		  array('id' => '1','menu_id' => '1','lang' => 'fr','status' => '1','title' => 'Principal'),
		  array('id' => '2','menu_id' => '1','lang' => 'nl','status' => '1','title' => 'Main'),
		  array('id' => '3','menu_id' => '1','lang' => 'en','status' => '1','title' => 'Main'),
		  array('id' => '4','menu_id' => '2','lang' => 'fr','status' => '1','title' => 'Pied de site'),
		  array('id' => '5','menu_id' => '2','lang' => 'nl','status' => '1','title' => 'Footer'),
		  array('id' => '6','menu_id' => '2','lang' => 'en','status' => '1','title' => 'Footer')
		);

		DB::table('menus')->insert( $typi_menus );
		DB::table('menus_translations')->insert( $typi_menus_translations );
		DB::table('menulinks')->insert( $typi_menulinks );
		DB::table('menulinks_translations')->insert( $typi_menulinks_translations );

	}

}