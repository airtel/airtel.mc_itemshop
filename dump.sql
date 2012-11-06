-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2012 at 12:29 AM
-- Server version: 5.5.24-0ubuntu0.12.04.1-log
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airtelmcshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `icon` smallint(5) unsigned NOT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `active`) VALUES
(1, 'Armor', 267, '1'),
(2, 'Resources', 17, '1'),
(3, 'Items', 47, '1'),
(4, 'Mechanics', 66, '0'),
(5, 'Organics', 363, '1');

-- --------------------------------------------------------

--
-- Table structure for table `enchantments`
--

CREATE TABLE IF NOT EXISTS `enchantments` (
  `enchantment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enchantment_group` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cmd` varchar(100) NOT NULL,
  `level_limit` tinyint(3) unsigned NOT NULL,
  `desc` text,
  `levelprice_sms_lv` varchar(5) DEFAULT NULL,
  `levelprice_ibank` varchar(5) DEFAULT NULL,
  `levelprice_paypal` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`enchantment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `enchantments`
--

INSERT INTO `enchantments` (`enchantment_id`, `enchantment_group`, `name`, `cmd`, `level_limit`, `desc`, `levelprice_sms_lv`, `levelprice_ibank`, `levelprice_paypal`) VALUES
(1, 'armor', 'Protection', 'protection', 4, 'Converts all damage from all sources (except from The Void, Hunger and the /kill command) to armor damage.', '15', '0.15', '0.25'),
(2, 'armor', 'Fire Protection', 'fireprotection', 4, 'Protection against fire.', '15', '0.15', '0.25'),
(3, 'armor', 'Feather Falling', 'featherfalling', 4, 'Protection against fall damage.', '15', '0.15', '0.25'),
(4, 'armor', 'Blast Protection', 'blastprotection', 4, 'Protection against explosions.', '15', '0.15', '0.25'),
(5, 'armor', 'Projectile Protection', 'projectileprotection', 4, 'Protection against projectile entities (e.g. arrows and ghast/blaze fireballs (only the initial impact)).', '15', '0.15', '0.25'),
(6, 'armor', 'Respiration', 'respiration', 3, 'Decreases the rate of air loss underwater; increases time between damage while suffocating.', '15', '0.15', '0.25'),
(7, 'armor', 'Aqua Affinity', 'aquaaffinity', 1, 'Increases underwater mining rate.', '15', '0.15', '0.25'),
(8, 'sword', 'Sharpness', 'sharpness', 5, 'Extra damage.', '15', '0.15', '0.25'),
(9, 'sword', 'Smite', 'smite', 5, 'Extra damage to zombies, zombie pigmen, withers and skeletons.', '15', '0.15', '0.25'),
(10, 'sword', 'Bane of Arthropods', 'baneofarthropods', 5, 'Extra damage to spiders, cave spiders and silverfish.', '15', '0.15', '0.25'),
(11, 'sword', 'Knockback', 'knockback', 2, 'Increases the knockback dealt when attacking mobs and players.', '15', '0.15', '0.25'),
(12, 'sword', 'Fire Aspect', 'fireaspect', 2, 'Lights the target on fire.', '15', '0.15', '0.25'),
(13, 'sword', 'Looting ', 'looting', 3, 'Mobs have a chance to drop more loot.', '15', '0.15', '0.25'),
(14, 'tool', 'Efficiency', 'efficiency', 5, 'Faster resource gathering while in use.', '15', '0.15', '0.25'),
(15, 'tool', 'Silk Touch', 'silktouch', 1, 'Blocks mined will drop themselves, even if it should drop something else (e.g. Stone will drop stone, not Cobblestone).', '15', '0.15', '0.25'),
(16, 'tool', 'Unbreaking', 'unbreaking', 3, 'At each use, there''s a chance the tool''s durability will not decrease.', '15', '0.15', '0.25'),
(17, 'tool', 'Fortune', 'fortune', 3, 'Can multiply the drop rate of items from blocks.', '15', '0.15', '0.25'),
(18, 'bow', 'Power', 'power', 4, 'Extra damage.', '15', '0.15', '0.25'),
(19, 'bow', 'Punch', 'punch', 2, 'Knockback effect on mobs and players', '15', '0.15', '0.25'),
(20, 'bow', 'Flame', 'flame', 1, 'Sets arrows, mobs, and players on fire.', '15', '0.15', '0.25'),
(21, 'bow', 'Infinity', 'infinity', 1, 'Gives unlimited shots with a single arrow (The bow still loses durability).', '15', '0.15', '0.25');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(10) unsigned NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_id` varchar(10) NOT NULL,
  `image_id` varchar(10) NOT NULL,
  `price_sms_lv` varchar(5) NOT NULL,
  `price_ibank` varchar(5) NOT NULL,
  `price_paypal` varchar(5) NOT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  `pieces` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `enchantments` varchar(50) DEFAULT NULL,
  `sub_type` enum('weapon','armor') DEFAULT NULL,
  `sub_material` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=181 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category`, `item_name`, `item_id`, `image_id`, `price_sms_lv`, `price_ibank`, `price_paypal`, `active`, `pieces`, `enchantments`, `sub_type`, `sub_material`) VALUES
(1, 2, 'Stone', '1', '1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(2, 2, 'Dirt', '3', '3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(3, 2, 'Cobblestone', '4', '4', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(4, 2, 'Wooden Plank (Oak)', '5', '5', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(5, 2, 'Wooden Plank (Spruce)', '5:1', '5-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(6, 2, 'Wooden Plank (Birch)', '5:2', '5-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(7, 2, 'Wooden Plank (Jungle)', '5:3', '5-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(8, 2, 'Sand', '12', '12', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(9, 2, 'Gravel', '13', '13', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(10, 2, 'Wood (Oak)', '17', '17', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(11, 2, 'Wood (Spruce)', '17:1', '17-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(12, 2, 'Wood (Birch)', '17:2', '17-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(13, 2, 'Wood (Jungle)', '17:3', '17-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(14, 1, 'Iron Shovel', '256', '256', '75', '0.75', '1.00', '1', 1, '[14,15,16,17]', 'weapon', 'iron'),
(15, 1, ' Iron Pickaxe', '257', '257', '75', '0.75', '1.00', '1', 1, '[14,15,16,17]', 'weapon', 'iron'),
(16, 1, 'Iron Axe', '258', '258', '75', '0.75', '1.00', '1', 1, '[14,15,16,17]', 'weapon', 'iron'),
(17, 1, 'Iron Sword', '267', '267', '75', '0.75', '1.00', '1', 1, '[8,9,10,11,12,13]', 'weapon', 'iron'),
(18, 1, 'Wooden Sword', '268', '268', '25', '0.25', '0.35', '1', 1, '[8,9,10,11,12,13]', 'weapon', 'wooden'),
(19, 1, 'Wooden Shovel', '269', '269', '25', '0.25', '0.35', '1', 1, '[14,15,16,17]', 'weapon', 'wooden'),
(20, 1, 'Wooden Pickaxe', '270', '270', '25', '0.25', '0.35', '1', 1, '[14,15,16,17]', 'weapon', 'wooden'),
(21, 1, 'Wooden Axe', '271', '271', '25', '0.25', '0.35', '1', 1, '[14,15,16,17]', 'weapon', 'wooden'),
(22, 1, 'Stone Sword', '272', '272', '35', '0.35', '0.45', '1', 1, '[8,9,10,11,12,13]', 'weapon', 'stone'),
(23, 1, 'Stone Shovel', '273', '273', '35', '0.35', '0.45', '1', 1, '[14,15,16,17]', 'weapon', 'stone'),
(24, 1, 'Stone Pickaxe', '274', '274', '35', '0.35', '0.45', '1', 1, '[14,15,16,17]', 'weapon', 'stone'),
(25, 1, 'Stone Axe', '275', '275', '35', '0.35', '0.45', '1', 1, '[14,15,16,17]', 'weapon', 'stone'),
(26, 1, 'Diamond Sword', '276', '276', '150', '1.50', '1.75', '1', 1, '[8,9,10,11,12,13]', 'weapon', 'diamond'),
(27, 1, 'Diamond Shovel', '277', '277', '150', '1.50', '1.75', '1', 1, '[14,15,16,17]', 'weapon', 'diamond'),
(28, 1, 'Diamond Pickaxe', '278', '278', '150', '1.50', '1.75', '1', 1, '[14,15,16,17]', 'weapon', 'diamond'),
(29, 1, 'Diamond Axe', '279', '279', '150', '1.50', '1.75', '1', 1, '[14,15,16,17]', 'weapon', 'diamond'),
(30, 1, 'Gold Sword', '283', '283', '95', '1.00', '1.15', '1', 1, '[8,9,10,11,12,13]', 'weapon', 'gold'),
(31, 1, 'Gold Shovel', '284', '284', '95', '1.00', '1.15', '1', 1, '[14,15,16,17]', 'weapon', 'gold'),
(32, 1, 'Gold Pickaxe', '285', '285', '95', '1.00', '1.15', '1', 1, '[14,15,16,17]', 'weapon', 'gold'),
(33, 1, 'Gold Axe', '286', '286', '95', '1.00', '1.15', '1', 1, '[14,15,16,17]', 'weapon', 'gold'),
(34, 1, 'Wooden Hoe', '290', '290', '35', '0.35', '0.35', '0', 1, NULL, 'weapon', 'wooden'),
(35, 1, 'Stone Hoe', '291', '291', '35', '0.35', '0.35', '0', 1, NULL, 'weapon', 'stone'),
(36, 1, 'Iron Hoe', '292', '292', '35', '0.35', '0.35', '0', 1, NULL, 'weapon', 'iron'),
(37, 1, 'Diamond Hoe', '293', '293', '35', '0.35', '0.35', '0', 1, NULL, 'weapon', 'diamond'),
(38, 1, 'Gold Hoe', '294', '294', '35', '0.35', '0.35', '0', 1, NULL, 'weapon', 'gold'),
(39, 1, 'Leather Helmet', '298', '298', '35', '0.35', '0.35', '1', 1, '[1,2,4,5,6,7]', 'armor', 'leather'),
(40, 1, 'Leather Chestplate', '299', '299', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'leather'),
(41, 1, 'Leather Leggings', '300', '300', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'leather'),
(42, 1, 'Leather Boots', '301', '301', '35', '0.35', '0.35', '1', 1, '[1,2,3,4,5]', 'armor', 'leather'),
(43, 1, 'Chainmail Helmet', '302', '302', '35', '0.35', '0.35', '1', 1, '[1,2,4,5,6,7]', 'armor', 'chainmail'),
(44, 1, 'Chainmail Chestplate', '303', '303', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'chainmail'),
(45, 1, 'Chainmail Leggings', '304', '304', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'chainmail'),
(46, 1, 'Chainmail Boots', '305', '305', '35', '0.35', '0.35', '1', 1, '[1,2,3,4,5]', 'armor', 'chainmail'),
(47, 1, 'Iron Helmet', '306', '306', '35', '0.35', '0.35', '1', 1, '[1,2,4,5,6,7]', 'armor', 'iron'),
(48, 1, 'Iron Chestplate', '307', '307', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'iron'),
(49, 1, 'Iron Leggings', '308', '308', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'iron'),
(50, 1, 'Iron Boots', '309', '309', '35', '0.35', '0.35', '1', 1, '[1,2,3,4,5]', 'armor', 'iron'),
(51, 1, 'Diamond Helmet', '310', '310', '35', '0.35', '0.35', '1', 1, '[1,2,4,5,6,7]', 'armor', 'diamond'),
(52, 1, 'Diamond Chestplate', '311', '311', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'diamond'),
(53, 1, 'Diamond Leggings', '312', '312', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'diamond'),
(54, 1, 'Diamond Boots', '313', '313', '35', '0.35', '0.35', '1', 1, '[1,2,3,4,5]', 'armor', 'diamond'),
(55, 1, 'Gold Helmet', '314', '314', '35', '0.35', '0.35', '1', 1, '[1,2,4,5,6,7]', 'armor', 'gold'),
(56, 1, 'Gold Chestplate', '315', '315', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'gold'),
(57, 1, 'Gold Leggings', '316', '316', '35', '0.35', '0.35', '1', 1, '[1,2,4,5]', 'armor', 'gold'),
(58, 1, 'Gold Boots', '317', '317', '35', '0.35', '0.35', '1', 1, '[1,2,3,4,5]', 'armor', 'gold'),
(59, 2, 'Glass', '20', '20', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(60, 2, 'Lapis Lazuli Ore', '21', '21', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(61, 2, 'Lapis Lazuli Block', '22', '22', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(62, 3, 'Dispenser', '23', '23', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(63, 2, 'Sandstone', '24', '24', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(64, 2, 'Sandstone (Chiseled)', '24:1', '24-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(65, 2, 'Sandstone (Smooth)', '24:2', '24-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(66, 2, 'Wool', '35', '35', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(67, 2, 'Orange Wool', '35:1', '35-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(68, 2, 'Magenta Wool', '35:2', '35-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(69, 2, 'Light Blue Wool', '35:3', '35-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(70, 2, 'Yellow Wool', '35:4', '35-4', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(71, 2, 'Lime Wool', '35:5', '35-5', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(72, 2, 'Pink Wool', '35:6', '35-6', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(73, 2, 'Gray Wool', '35:7', '35-7', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(74, 2, 'Light Gray Wool', '35:8', '35-8', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(75, 2, 'Cyan Wool', '35:9', '35-9', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(76, 2, 'Purple Wool', '35:10', '35-10', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(77, 2, 'Blue Wool', '35:11', '35-11', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(78, 2, 'Brown Wool', '35:12', '35-12', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(79, 2, 'Green Wool', '35:13', '35-13', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(80, 2, 'Red Wool', '35:14', '35-14', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(81, 2, 'Black Wool', '35:15', '35-15', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(82, 2, 'Stone Slab (Double)', '43', '43', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(83, 2, 'Sandstone Slab (Double)', '43:1', '43-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(84, 2, 'Wooden Slab (Double)', '43:2', '43-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(85, 2, 'Cobblestone Slab (Double)', '43:3', '43-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(86, 2, 'Brick Slab (Double)', '43:4', '43-4', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(87, 2, 'Stone Brick Slab (Double)', '43:5', '43-5', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(88, 2, 'Stone Slab', '44', '44', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(89, 2, 'Sandstone Slab', '44:1', '44-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(90, 2, 'Wooden Slab', '44:2', '44-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(91, 2, 'Cobblestone Slab', '44:3', '44-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(92, 2, 'Brick Slab', '44:4', '44-4', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(93, 2, 'Stone Brick Slab', '44:5', '44-5', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(94, 2, 'Brick', '45', '45', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(95, 2, 'Moss Stone', '48', '48', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(96, 2, 'Obsidian', '49', '49', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(97, 2, 'Wooden Stairs (Oak)', '53', '53', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(98, 2, 'Diamond Ore', '56', '56', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(99, 2, 'Cobblestone Stairs', '67', '67', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(100, 2, 'Stone Pressure Plate', '70', '70', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(101, 2, 'Wooden Pressure Plate', '72', '72', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(102, 2, 'Redstone Ore', '73', '73', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(103, 2, 'Netherrack', '87', '87', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(104, 2, 'Soul Sand', '88', '88', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(105, 2, 'Glowstone', '89', '89', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(106, 2, 'Jack-O-Lantern', '91', '91', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(107, 2, 'Stone Bricks', '98', '98', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(108, 2, 'Mossy Stone Bricks', '98:1', '98-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(109, 2, 'Cracked Stone Bricks', '98:2', '98-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(110, 2, 'Chiseled Stone Brick', '98:3', '98-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(111, 3, 'Powered Rail', '27', '27', '35', '0.35', '0.50', '1', 16, NULL, NULL, NULL),
(112, 3, 'Detector Rail', '28', '28', '35', '0.35', '0.50', '1', 16, NULL, NULL, NULL),
(113, 3, 'Sticky Piston', '29', '29', '35', '0.35', '0.50', '1', 8, NULL, NULL, NULL),
(114, 3, 'Piston', '33', '33', '35', '0.35', '0.50', '1', 8, NULL, NULL, NULL),
(115, 3, 'TNT', '46', '46', '35', '0.35', '0.50', '1', 8, NULL, NULL, NULL),
(116, 3, 'Bookcase', '47', '47', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(117, 3, 'Chest', '54', '54', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(118, 3, 'Workbench', '58', '58', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(119, 3, 'Furnace (Smelting)', '62', '62', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(120, 3, 'Mob Spawner', '52', '52', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(121, 3, 'Rail', '66', '66', '35', '0.35', '0.50', '1', 16, NULL, NULL, NULL),
(122, 2, 'Brick Stairs', '108', '108', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(123, 2, 'Stone Brick Stairs', '109', '109', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(124, 2, 'Nether Brick', '112', '112', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(125, 2, 'Nether Brick Fence', '113', '113', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(126, 2, 'Nether Brick Stairs', '114', '114', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(127, 3, 'Enchantment Table', '116', '116', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(128, 2, 'Redstone Lamp', '123', '123', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(129, 2, 'Oak-Wood Slab (Double)', '125', '125', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(130, 2, 'Spruce-Wood Slab (Double)', '125:1', '125-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(131, 2, 'Birch-Wood Slab (Double)', '125:2', '125-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(132, 2, 'Jungle-Wood Slab (Double)', '125:3', '125-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(133, 2, 'Oak-Wood Slab', '126', '126', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(134, 2, 'Spruce-Wood Slab', '126:1', '126-1', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(135, 2, 'Birch-Wood Slab', '126:2', '126-2', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(136, 2, 'Jungle-Wood Slab', '126:3', '126-3', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(137, 2, 'Sandstone Stairs', '128', '128', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(138, 3, 'Ender Chest', '130', '130', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(139, 2, 'Wooden Stairs (Spruce)', '134', '134', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(140, 2, 'Wooden Stairs (Birch)', '135', '135', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(141, 2, 'Wooden Stairs (Jungle)', '136', '136', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(142, 2, 'Beacon', '138', '138', '35', '0.35', '0.50', '1', 32, NULL, NULL, NULL),
(143, 3, 'Anvil', '145', '145', '35', '0.35', '0.50', '1', 1, NULL, NULL, NULL),
(144, 5, 'Apple', '260', '260', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(145, 5, 'Gold Apple', '322', '322', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(146, 3, 'Diamond Gem', '264', '264', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(147, 3, 'Iron Ingot', '265', '265', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(148, 3, 'Gold Ingot', '266', '266', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(149, 3, 'String', '287', '287', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(150, 3, 'Gunpowder', '289', '289', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(151, 5, 'Bread', '297', '297', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(152, 5, 'Raw Porkchop', '319', '319', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(153, 5, 'Cooked Porkchop', '320', '320', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(154, 5, 'Raw Fish', '349', '349', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(155, 5, 'Cooked Fish', '350', '350', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(156, 5, 'Raw Beef', '363', '363', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(157, 5, 'Steak', '364', '364', '15', '0.15', '0.25', '1', 64, NULL, NULL, NULL),
(158, 3, 'Coal', '263', '263', '35', '0.35', '0.50', '1', 64, NULL, NULL, NULL),
(159, 5, 'Regeneration Potion (2:00)', '373:8257', '373-8257', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(160, 5, 'Swiftness Potion (8:00)', '373:8258', '373-8258', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(161, 5, 'Fire Resistance Potion (8:00)', '373:8259', '373-8259', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(162, 5, 'Poison Potion (2:00)', '373:8260', '373-8260', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(163, 5, 'Night Vision Potion (8:00)', '373:8262', '373-8262', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(164, 5, 'Weakness Potion (4:00)', '373:8264', '373-8264', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(165, 5, 'Strength Potion (8:00)', '373:8265', '373-8265', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(166, 5, 'Slowness Potion (4:00)', '373:8266', '373-8266', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(167, 5, ' Invisibility Potion (8:00)', '373:8270', '373-8270', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(168, 5, 'Healing Potion', '373:8197', '373-8197', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(169, 5, 'Harming Potion', '373:8204', '373-8204', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(170, 5, 'Healing Splash', '373:16389', '373-16389', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(171, 5, 'Harming Splash', '373:16396', '373-16396', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(172, 5, 'Regeneration Splash (1:30)', '373:16449', '373-16449', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(173, 5, 'Swiftness Splash (6:00)', '373:16450', '373-16450', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(174, 5, 'Fire Resistance Splash (6:00)', '373:16451', '373-16451', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(175, 5, 'Poison Splash (1:30)', '373:16452', '373-16452', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(176, 5, 'Night Vision Splash (6:00)', '373:16454', '373-16454', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(177, 5, 'Weakness Splash (3:00)', '373:16456', '373-16456', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(178, 5, 'Strength Splash (6:00)', '373:16457', '373-16457', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(179, 5, 'Slowness Splash (3:00)', '373:16458', '373-16458', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL),
(180, 5, 'Invisibility Splash (6:00)', '373:16462', '373-16462', '15', '0.15', '0.25', '1', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mcshop_sessions`
--

CREATE TABLE IF NOT EXISTS `mcshop_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcshop_sessions`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
