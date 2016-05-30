CREATE TABLE `data` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `data` (`title`, `text`) VALUES('Hello World!', 'CodeIgniter is a powerful PHP framework with a very small footprint, built for PHP coders who need a simple and elegant toolkit to create full-featured web applications. If you''re a developer who lives in the real world of shared hosting accounts and clients with deadlines, and if you''re tired of ponderously large and thoroughly undocumented frameworks');