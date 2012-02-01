CREATE TABLE IF NOT EXISTS `rewrites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `is_regexp` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
