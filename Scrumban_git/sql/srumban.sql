-- phpMyAdmin SQL Dump
-- version 2.6.4-pl4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 11, 2012 at 11:26 AM
-- Server version: 5.0.37
-- PHP Version: 4.4.7
-- 
-- Database: `scrumban`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `main_logs`
-- 

CREATE TABLE `main_logs` (
  `log_id` int(9) NOT NULL auto_increment,
  `log_task` int(9) NOT NULL,
  `log_user` int(9) NOT NULL,
  `log_state` int(4) NOT NULL,
  `log_date` date NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `log_task` (`log_task`,`log_user`,`log_state`,`log_date`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `main_projects`
-- 

CREATE TABLE `main_projects` (
  `pro_id` int(9) NOT NULL auto_increment,
  `pro_name` varchar(100) NOT NULL,
  `pro_status` int(1) NOT NULL default '1',
  `pro_team` int(9) NOT NULL default '1',
  PRIMARY KEY  (`pro_id`),
  KEY `pro_name` (`pro_name`,`pro_status`),
  KEY `pro_team` (`pro_team`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `main_sprints`
-- 

CREATE TABLE `main_sprints` (
  `sprint_id` int(9) NOT NULL auto_increment,
  `sprint_project` int(9) NOT NULL,
  `sprint_start` date NOT NULL,
  `sprint_end` date NOT NULL,
  `sprint_status` int(11) default NULL,
  PRIMARY KEY  (`sprint_id`),
  KEY `sprint_project` (`sprint_project`,`sprint_start`,`sprint_end`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `main_tasks`
-- 

CREATE TABLE `main_tasks` (
  `task_id` int(9) NOT NULL auto_increment,
  `task_project` int(9) NOT NULL,
  `task_sprint` int(9) NOT NULL,
  `task_user` int(9) NOT NULL,
  `task_state` int(9) NOT NULL,
  `task_units` int(9) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `task_detail` text NOT NULL,
  PRIMARY KEY  (`task_id`),
  KEY `task_project` (`task_project`,`task_user`,`task_state`,`task_units`,`task_title`),
  KEY `task_sprint` (`task_sprint`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `main_teams`
-- 

CREATE TABLE `main_teams` (
  `team_id` int(9) NOT NULL auto_increment,
  `team_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`team_id`),
  KEY `team_name` (`team_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `main_users`
-- 

CREATE TABLE `main_users` (
  `use_id` int(9) NOT NULL auto_increment,
  `use_email` varchar(100) NOT NULL,
  `use_password` varchar(40) NOT NULL,
  `use_key` varchar(100) NOT NULL,
  `use_name` varchar(100) NOT NULL,
  `use_team` int(9) NOT NULL default '1',
  PRIMARY KEY  (`use_id`),
  KEY `use_email` (`use_email`,`use_password`,`use_key`),
  KEY `use_team` (`use_team`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
