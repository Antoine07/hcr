
DROP DATABASE IF EXISTS hcr_db;

--
-- Base de données :  `hcr_db`
--
CREATE DATABASE `hcr_db`;

use `hcr_db`;
-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `aerodynamics` SMALLINT NOT NULL,
  `solidity` SMALLINT NOT NULL,
  `cosiness` SMALLINT NOT NULL,
  `shipping` SMALLINT NOT NULL,
  `speed` SMALLINT NOT NULL,
  `price` INT(10) UNSIGNED NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `timestamp` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `spaceships`
--

CREATE TABLE `spaceships` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `pilot_id` int(10) UNSIGNED DEFAULT NULL,
  `mechanic_id` int(10) UNSIGNED DEFAULT NULL,
  `nav_module_id` int(10) UNSIGNED DEFAULT NULL,
  `pow_module_id` int(10) UNSIGNED DEFAULT NULL,
  `comp_module_id_1`int(10) UNSIGNED DEFAULT NULL,
  `comp_module_id_2`int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Structure de la table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `activity_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` SMALLINT UNSIGNED NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `strength` SMALLINT UNSIGNED NOT NULL,
  `dexterity` SMALLINT UNSIGNED NOT NULL,
  `stamina` SMALLINT UNSIGNED NOT NULL,
  `speed` SMALLINT UNSIGNED NOT NULL,
  `intelligence` SMALLINT UNSIGNED NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `npcs`
--

CREATE TABLE `npcs` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `name` VARCHAR(255) NOT NULL,
  `strength` SMALLINT UNSIGNED NOT NULL,
  `dexterity` SMALLINT UNSIGNED NOT NULL,
  `stamina` SMALLINT UNSIGNED NOT NULL,
  `speed` SMALLINT UNSIGNED NOT NULL,
  `intelligence` SMALLINT UNSIGNED NOT NULL,
  `price` SMALLINT UNSIGNED NOT NULL,
  `job` VARCHAR(30) NOT NULL,
  `race` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `score` INT(10) UNSIGNED NOT NULL,
  `credit` INT(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` INT(10) UNSIGNED NOT NULL,
  `team_id` INT(10) UNSIGNED DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `creation_date` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `races`
--

CREATE TABLE `races` (
  `id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `duration` INT(10) NOT NULL,
  `ladder` TINYINT(1) NOT NULL DEFAULT 0,
  `date` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `spaceships`
--
ALTER TABLE `spaceships`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `NPCs`
--
ALTER TABLE `npcs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Index pour la table `spaceships`
--
ALTER TABLE `spaceships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Index pour la table `NPCs`
--
ALTER TABLE `npcs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Index pour la table `teams`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Index pour la table `teams`
--
ALTER TABLE `equipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Index pour la table `races`
--
ALTER TABLE `races`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE modules 
ADD CONSTRAINT modules_team_id_teams_id
FOREIGN KEY(team_id) 
REFERENCES teams(id) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_team_id_teams_id`
FOREIGN KEY(`team_id`) 
REFERENCES `teams`(`id`) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_pilot_id_npcs_id`
FOREIGN KEY(`pilot_id`) 
REFERENCES `npcs`(`id`) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_mechanic_id_npcs_id`
FOREIGN KEY(`mechanic_id`) 
REFERENCES `npcs`(`id`) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_nav_module_id_modules_id`
FOREIGN KEY(`nav_module_id`) 
REFERENCES `modules`(`id`) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_pow_module_id_modules_id`
FOREIGN KEY(`pow_module_id`)
REFERENCES `modules`(`id`) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_comp_module_id_1_modules_id`
FOREIGN KEY(`comp_module_id_1`)
REFERENCES `modules`(`id`) 
ON DELETE SET NULL;

ALTER TABLE `spaceships` 
ADD CONSTRAINT `spaceships_comp_module_id_2_modules_id`
FOREIGN KEY(`comp_module_id_2`)
REFERENCES `modules`(`id`) 
ON DELETE SET NULL;

ALTER TABLE npcs 
ADD CONSTRAINT npcs_team_id_teams_id 
FOREIGN KEY(team_id) 
REFERENCES teams(id) 
ON DELETE SET NULL;

ALTER TABLE users 
ADD CONSTRAINT users_team_id_teams_id 
FOREIGN KEY(team_id) 
REFERENCES teams(id) 
ON DELETE SET NULL;

ALTER TABLE equipments 
ADD CONSTRAINT equipments_team_id_teams_id 
FOREIGN KEY(team_id) 
REFERENCES teams(id) 
ON DELETE SET NULL;

ALTER TABLE equipments 
ADD CONSTRAINT equipments_activity_id_activities_id 
FOREIGN KEY(activity_id) 
REFERENCES activities(id) 
ON DELETE SET NULL;

