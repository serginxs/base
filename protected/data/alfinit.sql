-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 22 2014 г., 15:55
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `alfinit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(56) NOT NULL,
  `value` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `update_time` datetime NOT NULL,
  `type` varchar(50) NOT NULL,
  `section` tinyint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `name`, `value`, `title`, `update_time`, `type`, `section`) VALUES
(1, 'site_name', 'ACVA', 'Название сайта', '2012-12-17 21:19:20', 'str', 0),
(2, 'key_words', 'Дизельные электростанции', 'Ключевые слова сайта (keywords)', '2012-02-24 10:43:46', 'str', 0),
(7, 'cachingTime', '840000', 'Время жизни кэша (сек.)', '2012-12-17 22:14:57', 'int', 0),
(4, 'adminEmail', 'admin@gmail.com', 'Email Админа  (для формы обратной связи)', '2012-02-24 10:43:37', 'email', 0),
(5, 'defaultPageSize', '10', 'Выводить элементов на страницу', '2012-02-29 02:30:05', 'int', 0),
(8, 'sendActivationMail', '0', 'Активировать пользователей почтой ', '2013-05-03 13:07:28', 'int', 1),
(12, 'activeAfterRegister', '1', 'Активировать пользователей автоматически ', '2013-05-03 13:07:28', 'int', 1),
(13, 'skype', 'acva', 'Skype', '2013-05-03 13:07:28', 'str', 0),
(14, 'phone', '+38 0512 72 22 22', 'Телефоны', '2013-07-23 14:43:13', 'str', 0),
(15, 'adress', 'г. Николаев, ул. Бузника 4', 'Адрес', '2013-07-23 14:45:19', 'str', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `versions_data` text NOT NULL,
  `name` tinyint(1) NOT NULL DEFAULT '1',
  `description` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_gallery_photo`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `name` varchar(512) NOT NULL DEFAULT '',
  `description` text,
  `file_name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_gallery_photo_gallery1` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_lookup`
--

CREATE TABLE IF NOT EXISTS `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Основная старница', 0, 'SiteSection', 0),
(2, 'Проекты', 1, 'SiteSection', 1),
(3, 'Раздел2', 2, 'SiteSection', 2),
(4, 'Раздел3', 3, 'SiteSection', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_tag` varchar(255) NOT NULL,
  `key_words` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  `img` varchar(50) NOT NULL,
  `create_time` date NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `title_tag`, `key_words`, `description`, `alias`, `title`, `short`, `text`, `active`, `img`, `create_time`, `update_time`) VALUES
(1, 'Новость1', 'Новость1', 'Новость1', 'news-one', 'Новость1', '<p>Новость1</p>', '<p>Новость1</p>', 1, 'news__1392646724.jpg', '2014-02-17', '2014-02-17 14:18:44');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `alias` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `title_tag` varchar(128) NOT NULL,
  `key_words` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text NOT NULL,
  `text4` text NOT NULL,
  `text5` text NOT NULL,
  `sorter` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `img` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`),
  KEY `parent_id` (`type`),
  KEY `type` (`type`),
  KEY `id` (`id`),
  KEY `alias_2` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `title`, `alias`, `type`, `title_tag`, `key_words`, `description`, `text`, `text1`, `text2`, `text3`, `text4`, `text5`, `sorter`, `active`, `img`) VALUES
(1, 'Главная', 'index', 0, 'Главная', 'Главная', 'Главная', '<h3>О компании</h3>\r\n<p>ООО &laquo;Альфинит&raquo; имеет более чем 15-летний опыт работы на рынке информационных технологий и является одним из лидеров по внедрению различных программных продуктов и решений в области создания информационных систем для автоматизации бизнес-процессов предприятий.<br /><br />Одним из достоинств нашей компании является полномасштабный спектр инновационных и комплексных проектных решений и услуг в сфере информационных технологий, предлагаемых нашим клиентам.<br /><br />Высокое качество оказываемых услуг является стратегической целью нашей компании.</p>', '<p>We have been working with Joe as an SEO consultant on a number of things this year and his wealth of experience and insight has been an invaluable addition to our team.</p>\r\n<p>Jhon Martin</p>\r\n<p>&nbsp;</p>', '<p>We have been working with Joe as an SEO consultant on a number of things this year and his wealth of experience and insight has been an invaluable addition to our team.</p>\r\n<p>Jhon Martin</p>', '<p>We have been working with Joe as an SEO consultant on a number of things this year and his wealth of experience and insight has been an invaluable addition to our team.</p>\r\n<p>Jhon Martin</p>', '', '', 0, 1, ''),
(2, 'О компании', 'about', 0, '', '', '', '<div class="box">\r\n<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>\r\n<p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>\r\n<p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>\r\n<h3>Finibus Bonorum et Malorum", написанный Цицероном в 45 году н.э.</h3>\r\n<p>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p>\r\n<p>"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p>\r\n</div>', '', '', '', '', '', 1, 1, ''),
(3, 'Контакты', 'contacts', 0, '', '', '', '<p>Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или "невозможных" слов.</p>', '<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=-pkM8LIQ3vR5JitOyEV3KaSV8Xk1yHue&width=100%&height=450"></script>', '', '', '', '', 2, 1, ''),
(4, 'Новости', 'news', 0, '', '', '', '<p>Новости</p>', '', '', '', '', '', 3, 1, ''),
(5, 'Услуги', 'services', 0, '', '', '', '<p>&nbsp;Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>', '', '', '', '', '', 4, 1, ''),
(6, 'Технологии', 'technology', 0, '', '', '', '<p>&nbsp;&nbsp; Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или "невозможных" слов.</p>', '', '', '', '', '', 5, 1, ''),
(7, 'Проекты', 'projects', 0, 'Проекты', 'Проекты', 'Проекты', '<p>Проекты</p>', '', '', '', '', '', 6, 1, ''),
(8, 'Вакансии', 'vacancy', 0, '', '', '', '<p>&nbsp; Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги "de Finibus Bonorum et Malorum" ("О пределах добра и зла"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, "Lorem ipsum dolor sit amet..", происходит от одной из строк в разделе 1.10.32</p>\r\n<p>Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 "de Finibus Bonorum et Malorum" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.</p>', '', '', '', '', '', 7, 1, ''),
(9, 'Клиенты', 'clients', 0, 'Клиенты', 'Клиенты', 'Клиенты', '<p>Клиенты</p>', '', '', '', '', '', 8, 1, ''),
(10, 'Отзывы', 'reviews', 0, '', '', '', '<p>Отзывы</p>', '', '', '', '', '', 9, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_partner`
--

CREATE TABLE IF NOT EXISTS `tbl_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  `sorter` int(11) NOT NULL,
  `onmain` tinyint(4) NOT NULL,
  `img` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_partner`
--

INSERT INTO `tbl_partner` (`id`, `title`, `text`, `active`, `sorter`, `onmain`, `img`) VALUES
(1, 'Министерство образования', '<p>Министерство образования</p>', 1, 1, 1, 'partner__1392888200.jpg'),
(2, 'Acva', '<p>Acva</p>', 1, 2, 1, 'partner__1392888210.jpg'),
(3, 'Департамент образования', '<p>Департамент образования</p>', 1, 3, 0, 'partner__1392888221.jpg'),
(4, 'Test', '<p>sdfsdf</p>', 1, 4, 1, 'partner__1392900708.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_tag` varchar(255) NOT NULL,
  `key_words` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  `img` varchar(50) NOT NULL,
  `sorter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `title_tag`, `key_words`, `description`, `alias`, `title`, `short`, `text`, `active`, `img`, `sorter`) VALUES
(1, '', '', '', '', 'Проект  Депортаметна образования', '', '<p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>', 1, '', 1),
(2, '', '', '', '', 'Проект Министерства образования', '', '<p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>', 1, '', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_review`
--

CREATE TABLE IF NOT EXISTS `tbl_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_tag` varchar(255) NOT NULL,
  `key_words` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  `img` varchar(50) NOT NULL,
  `sorter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `title_tag`, `key_words`, `description`, `alias`, `title`, `short`, `text`, `active`, `img`, `sorter`) VALUES
(1, '', '', '', '', 'Транспортная компания "Автомир"', '', '<p>&nbsp;Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца.</p>', 1, '', 1),
(2, '', '', '', '', 'ООО "Югснаб"', '', '<p>&nbsp;Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>', 1, '', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_slider`
--

CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(50) NOT NULL,
  `sorter` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `url`, `text`, `img`, `sorter`, `active`) VALUES
(22, '', '', '', 'slider__1398170278.jpg', 1, 1),
(21, '', '', '', 'slider__1398170313.jpg', 3, 1),
(20, '', '', '', 'slider__1398170295.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `isAdmin`) VALUES
(1, 'admin', '$2a$13$W2P0rEpjottqxw/8GkizFuMzg7wHlqxtErYQfSzP5xVSu/TiK1TNS', '', 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_gallery_photo`
--
ALTER TABLE `tbl_gallery_photo`
  ADD CONSTRAINT `fk_gallery_photo_gallery1` FOREIGN KEY (`gallery_id`) REFERENCES `tbl_gallery` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
