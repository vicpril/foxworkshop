<?php
/**
 * Plugin Name:       Art WooCommerce Russian Region
 * Plugin URI:        https://wpruse.ru/?p=2609
 * Description:       Плагин под WooCommerce.  Подключает регионы для России в настройках доставки и на странице оформления заказа
 * Version:           1.0
 * Author:            Artem Abramovich
 * Author URI:        https://wpruse.ru/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:
 * Domain Path:
 *
 * WC requires at least: 3.3.0
 * WC tested up to: 3.3.5
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_filter( 'woocommerce_states', 'awrr_states_russia' );
function awrr_states_russia( $states ) {
	$states['RU'] = array(
		"МОСКВА"                                 => " Москва",
		"САНКТ-ПЕТЕРБУРГ"                        => " Санкт-Петербург",
		"АБАКАН"                                 => " Абакан",
		"АНАДЫРЬ"                                => " Анадырь",
		"АНАПА"                                  => " Анапа",
		"АРХАНГЕЛЬСК"                            => " Архангельск",
		"АСТРАХАНЬ"                              => " Астрахань",
		"БАЙКОНУР"                               => " Байконур",
		"БАРНАУЛ"                                => " Барнаул",
		"БЕЛГОРОД"                               => " Белгород",
		"БИРОБИДЖАН"                             => " Биробиджан",
		"БЛАГОВЕЩЕНСК"                           => " Благовещенск",
		"БРЯНСК"                                 => " Брянск",
		"ВЕЛИКИЙ НОВГОРОД"                       => " Великий Новгород",
		"ВЛАДИВОСТОК"                            => " Владивосток",
		"ВЛАДИКАВКАЗ"                            => " Владикавказ",
		"ВЛАДИМИР"                               => " Владимир",
		"ВОЛГОГРАД"                              => " Волгоград",
		"ВОЛОГДА"                                => " Вологда",
		"ВОРКУТА"                                => " Воркута",
		"ВОРОНЕЖ"                                => " Воронеж",
		"ГОРНО-АЛТАЙСК"                          => " Горно-Алтайск",
		"ГРОЗНЫЙ"                                => " Грозный",
		"ДУДИНКА"                                => " Дудинка",
		"ЕКАТЕРИНБУРГ"                           => " Екатеринбург",
		"ЕЛИЗОВО"                                => " Елизово",
		"ИВАНОВО"                                => " Иваново",
		"ИЖЕВСК"                                 => " Ижевск",
		"ИРКУТСК"                                => " Иркутск",
		"ЙОШКАР-ОЛА"                             => " Йошкар-Ола",
		"КАЗАНЬ"                                 => " Казань",
		"КАЛИНИНГРАД"                            => " Калининград",
		"КАЛУГА"                                 => " Калуга",
		"КЕМЕРОВО"                               => " Кемерово",
		"КИРОВ"                                  => " Киров",
		"КОСТРОМА"                               => " Кострома",
		"КОСТОМУКША"                             => " Костомукша",
		"КРАСНОДАР"                              => " Краснодар",
		"КРАСНОЯРСК"                             => " Красноярск",
		"КУРГАН"                                 => " Курган",
		"КУРСК"                                  => " Курск",
		"КЫЗЫЛ"                                  => " Кызыл",
		"ЛИПЕЦК"                                 => " Липецк",
		"МАГАДАН"                                => " Магадан",
		"МАГНИТОГОРСК"                           => " Магнитогорск",
		"МАЙКОП"                                 => " Майкоп",
		"МАХАЧКАЛА"                              => " Махачкала",
		"МИНЕРАЛЬНЫЕ ВОДЫ"                       => " Минеральные Воды",
		"МИРНЫЙ"                                 => " Мирный",
		"МУРМАНСК"                               => " Мурманск",
		"МЫТИЩИ"                                 => " Мытищи",
		"НАБЕРЕЖНЫЕ ЧЕЛНЫ"                       => " Набережные Челны",
		"НАДЫМ"                                  => " Надым",
		"НАЗРАНЬ"                                => " Назрань",
		"НАЛЬЧИК"                                => " Нальчик",
		"НАРЬЯН-МАР"                             => " Нарьян-Мар",
		"НИЖНЕВАРТОВСК"                          => " Нижневартовск",
		"НОВОКУЗНЕЦК"                            => " Новокузнецк",
		"НОВОРОССИЙСК"                           => " Новороссийск",
		"НОВОСИБИРСК"                            => " Новосибирск",
		"НЕРЮНГРИ"                               => " Нерюнгри",
		"НЕФТЕЮГАНСК"                            => " Нефтеюганск",
		"НИЖНИЙ НОВГОРОД"                        => " Нижний Новгород",
		"НОВЫЙ УРЕНГОЙ"                          => " Новый Уренгой",
		"НОРИЛЬСК"                               => " Норильск",
		"НОЯБРЬСК"                               => " Ноябрьск",
		"ОМСК"                                   => " Омск",
		"ОРЕНБУРГ"                               => " Оренбург",
		"ОРЁЛ"                                   => " Орел",
		"ПЕНЗА"                                  => " Пенза",
		"ПЕРМЬ"                                  => " Пермь",
		"ПЕТРОЗАВОДСК"                           => " Петрозаводск",
		"ПЕТРОПАВЛОВСК-КАМЧАТСКИЙ"               => " Петропавловск-Камчатский",
		"ПСКОВ"                                  => " Псков",
		"РОСТОВ-НА-ДОНУ"                         => " Ростов-на-Дону",
		"РЯЗАНЬ"                                 => " Рязань",
		"САЛЕХАРД"                               => " Салехард",
		"САМАРА"                                 => " Самара",
		"САРАНСК"                                => " Саранск",
		"САРАТОВ"                                => " Саратов",
		"СЕВАСТОПОЛЬ"                            => " Севастополь",
		"СИМФЕРОПОЛЬ"                            => " Симферополь",
		"СМОЛЕНСК"                               => " Смоленск",
		"СОЧИ"                                   => " Сочи",
		"СТАВРОПОЛЬ"                             => " Ставрополь",
		"СТРЕЖЕВОЙ"                              => " Стрежевой",
		"СУРГУТ"                                 => " Сургут",
		"СЫКТЫВКАР"                              => " Сыктывкар",
		"ТАМБОВ"                                 => " Тамбов",
		"ТВЕРЬ"                                  => " Тверь",
		"ТОЛЬЯТТИ"                               => " Тольятти",
		"ТОМСК"                                  => " Томск",
		"ТУЛА"                                   => " Тула",
		"ТЫНДА"                                  => " Тында",
		"ТЮМЕНЬ"                                 => " Тюмень",
		"УЛАН-УДЭ"                               => " Улан-Удэ",
		"УЛЬЯНОВСК"                              => " Ульяновск",
		"УСИНСК"                                 => " Усинск",
		"УФА"                                    => " Уфа",
		"УХТА"                                   => " Ухта",
		"ХАБАРОВСК"                              => " Хабаровск",
		"ХАНТЫ-МАНСИЙСК"                         => " Ханты-Мансийск",
		"ХОЛМСК"                                 => " Холмск",
		"ЧЕБОКСАРЫ"                              => " Чебоксары",
		"ЧЕЛЯБИНСК"                              => " Челябинск",
		"ЧЕРЕПОВЕЦ"                              => " Череповец",
		"ЧЕРКЕССК"                               => " Черкесск",
		"ЧИТА"                                   => " Чита",
		"ЭЛИСТА"                                 => " Элиста",
		"ЮЖНО-САХАЛИНСК"                         => " Южно-Сахалинск",
		"ЯКУТСК"                                 => " Якутск",
		"ЯРОСЛАВЛЬ"                              => " Ярославль",
		"АДЫГЕЯ РЕСПУБЛИКА"                      => " Адыгея респ.",
		"АЛТАЙ РЕСПУБЛИКА"                       => " Алтай респ.",
		"АЛТАЙСКИЙ КРАЙ"                         => " Алтайский край",
		"АМУРСКАЯ ОБЛАСТЬ"                       => " Амурская обл.",
		"АРХАНГЕЛЬСКАЯ ОБЛАСТЬ"                  => " Архангельская обл.",
		"АСТРАХАНСКАЯ ОБЛАСТЬ"                   => " Астраханская обл.",
		"БАШКОРТОСТАН РЕСПУБЛИКА"                => " Башкортостан респ.",
		"БЕЛГОРОДСКАЯ ОБЛАСТЬ"                   => " Белгородская обл.",
		"БРЯНСКАЯ ОБЛАСТЬ"                       => " Брянская обл.",
		"БУРЯТИЯ РЕСПУБЛИКА"                     => " Бурятия респ.",
		"ВЛАДИМИРСКАЯ ОБЛАСТЬ"                   => " Владимирская обл.",
		"ВОЛГОГРАДСКАЯ ОБЛАСТЬ"                  => " Волгоградская обл.",
		"ВОЛОГОДСКАЯ ОБЛАСТЬ"                    => " Вологодская обл.",
		"ВОРОНЕЖСКАЯ ОБЛАСТЬ"                    => " Воронежская обл.",
		"ДАГЕСТАН РЕСПУБЛИКА"                    => " Дагестан респ.",
		"ЕВРЕЙСКАЯ АВТОНОМНАЯ ОБЛАСТЬ"           => " Еврейская авт.обл.",
		"ЗАБАЙКАЛЬСКИЙ КРАЙ"                     => " Забайкальский край",
		"ИВАНОВСКАЯ ОБЛАСТЬ"                     => " Ивановская обл.",
		"ИНГУШЕТИЯ РЕСПУБЛИКА"                   => " Ингушетия респ.",
		"ИРКУТСКАЯ ОБЛАСТЬ"                      => " Иркутская обл.",
		"КАБАРДИНО-БАЛКАРСКАЯ РЕСПУБЛИКА"        => " Кабардино-Балкарская респ.",
		"КАЛИНИНГРАДСКАЯ ОБЛАСТЬ"                => " Калининградская обл.",
		"КАЛМЫКИЯ РЕСПУБЛИКА"                    => " Калмыкия респ.",
		"КАЛУЖСКАЯ ОБЛАСТЬ"                      => " Калужская обл.",
		"КАМЧАТСКИЙ КРАЙ"                        => " Камчатский край",
		"КАРАЧАЕВО-ЧЕРКЕССКАЯ РЕСПУБЛИКА"        => " Карачаево-Черкесская респ.",
		"КАРЕЛИЯ РЕСПУБЛИКА"                     => " Карелия респ.",
		"КЕМЕРОВСКАЯ ОБЛАСТЬ"                    => " Кемеровская обл.",
		"КИРОВСКАЯ ОБЛАСТЬ"                      => " Кировская обл.",
		"КОМИ РЕСПУБЛИКА"                        => " Коми респ.",
		"КОСТРОМСКАЯ ОБЛАСТЬ"                    => " Костромская обл.",
		"КРАСНОДАРСКИЙ КРАЙ"                     => " Краснодарский край",
		"КРЫМ РЕСПУБЛИКА"                        => " Крым республика",
		"КРАСНОЯРСКИЙ КРАЙ"                      => " Красноярский край",
		"КУРГАНСКАЯ ОБЛАСТЬ"                     => " Курганская обл.",
		"КУРСКАЯ ОБЛАСТЬ"                        => " Курская обл.",
		"ЛЕНИНГРАДСКАЯ ОБЛАСТЬ"                  => " Ленинградская обл.",
		"ЛИПЕЦКАЯ ОБЛАСТЬ"                       => " Липецкая обл.",
		"МАГАДАНСКАЯ ОБЛАСТЬ"                    => " Магаданская обл.",
		"МАРИЙ ЭЛ РЕСПУБЛИКА"                    => " Марий Эл респ.",
		"МОРДОВИЯ РЕСПУБЛИКА"                    => " Мордовия респ.",
		"МОСКОВСКАЯ ОБЛАСТЬ"                     => " Московская обл.",
		"МУРМАНСКАЯ ОБЛАСТЬ"                     => " Мурманская обл.",
		"НЕНЕЦКИЙ АВТОНОМНЫЙ ОКРУГ"              => " Ненецкий АО",
		"НИЖЕГОРОДСКАЯ ОБЛАСТЬ"                  => " Нижегородская обл.",
		"НОВГОРОДСКАЯ ОБЛАСТЬ"                   => " Новгородская обл.",
		"НОВОСИБИРСКАЯ ОБЛАСТЬ"                  => " Новосибирская обл.",
		"ОМСКАЯ ОБЛАСТЬ"                         => " Омская обл.",
		"ОРЕНБУРГСКАЯ ОБЛАСТЬ"                   => " Оренбургская обл.",
		"ОРЛОВСКАЯ ОБЛАСТЬ"                      => " Орловская обл.",
		"ПЕНЗЕНСКАЯ ОБЛАСТЬ"                     => " Пензенская обл.",
		"ПЕРМСКИЙ КРАЙ"                          => " Пермский край",
		"ПРИМОРСКИЙ КРАЙ"                        => " Приморский край",
		"ПСКОВСКАЯ ОБЛАСТЬ"                      => " Псковская обл.",
		"РОСТОВСКАЯ ОБЛАСТЬ"                     => " Ростовская обл.",
		"РЯЗАНСКАЯ ОБЛАСТЬ"                      => " Рязанская обл.",
		"САМАРСКАЯ ОБЛАСТЬ"                      => " Самарская обл.",
		"САРАТОВСКАЯ ОБЛАСТЬ"                    => " Саратовская обл.",
		"САХА (ЯКУТИЯ) РЕСПУБЛИКА"               => " Саха (Якутия) респ.",
		"САХАЛИНСКАЯ ОБЛАСТЬ"                    => " Сахалинская обл.",
		"СВЕРДЛОВСКАЯ ОБЛАСТЬ"                   => " Свердловская обл.",
		"СЕВЕРНАЯ ОСЕТИЯ-АЛАНИЯ РЕСПУБЛИКА"      => " Северная Осетия - Алания респ.",
		"СМОЛЕНСКАЯ ОБЛАСТЬ"                     => " Смоленская обл.",
		"СТАВРОПОЛЬСКИЙ КРАЙ"                    => " Ставропольский край",
		"ТАЙМЫРСКИЙ ДОЛГАНО-НЕНЕЦКИЙ РАЙОН"      => " Таймырский Долгано-Ненецкий р-н",
		"ТАМБОВСКАЯ ОБЛАСТЬ"                     => " Тамбовская обл.",
		"ТАТАРСТАН РЕСПУБЛИКА"                   => " Татарстан респ.",
		"ТВЕРСКАЯ ОБЛАСТЬ"                       => " Тверская обл.",
		"ТОМСКАЯ ОБЛАСТЬ"                        => " Томская обл.",
		"ТУЛЬСКАЯ ОБЛАСТЬ"                       => " Тульская обл.",
		"ТЫВА РЕСПУБЛИКА"                        => " Тыва респ.",
		"ТЮМЕНСКАЯ ОБЛАСТЬ"                      => " Тюменская обл.",
		"УДМУРТСКАЯ РЕСПУБЛИКА"                  => " Удмуртская респ.",
		"УЛЬЯНОВСКАЯ ОБЛАСТЬ"                    => " Ульяновская обл.",
		"ХАБАРОВСКИЙ КРАЙ"                       => " Хабаровский край",
		"ХАКАСИЯ РЕСПУБЛИКА"                     => " Хакасия респ.",
		"ХАНТЫ-МАНСИЙСКИЙ-ЮГРА АВТОНОМНЫЙ ОКРУГ" => " Ханты-Мансийский АО - Югра",
		"ЧЕЛЯБИНСКАЯ ОБЛАСТЬ"                    => " Челябинская обл.",
		"ЧЕЧЕНСКАЯ РЕСПУБЛИКА"                   => " Чеченская респ.",
		"ЧУВАШСКАЯ РЕСПУБЛИКА"                   => " Чувашия респ.",
		"ЧУКОТСКИЙ АВТОНОМНЫЙ ОКРУГ"             => " Чукотский АО",
		"ЯМАЛО-НЕНЕЦКИЙ АВТОНОМНЫЙ ОКРУГ"        => " Ямало-Ненецкий АО",
		"ЯРОСЛАВСКАЯ ОБЛАСТЬ"                    => " Ярославская обл.",
	);
	
	return $states;
}
