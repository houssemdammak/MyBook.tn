-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2023 at 07:11 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `price` float NOT NULL,
  `stock_statut` varchar(255) NOT NULL,
  `promotion_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `promotionConstraint` (`promotion_id`),
  KEY `categoryConstraint` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_name`, `category_id`, `price`, `stock_statut`, `promotion_id`, `image_path`, `description`, `stock`) VALUES
(1, 'Atomic Habits', 'James Clear', 8, 60, 'Not Available', 1, 'assets\\images\\Categorie\\Self Help\\Atomic Habits.jpg', 'Atomic Habits by James Clear is a self-help book that provides a framework for building good habits and breaking bad ones. It offers practical strategies for making small, consistent changes that can lead to significant personal growth.', 4),
(2, 'The Subtle Art Of Not Giving A Fuck ', 'MARK MANSON', 8, 83, 'Available', 1, 'assets\\images\\Categorie\\Self Help\\the  subtle art of not giving  a fuck.jpg', 'In this generation-defining self-help guide, a superstar blogger cuts through the crap to show us how to stop trying to be \"positive\" all the time so that we can truly become better, happier people. For decades, we\'ve been told that positive thinking is the key to a happy, rich life.\"Let\'s be honest, shit is f**ked and we have to live with it.\" In his wildly popular Internet blog, Manson doesn\'t sugarcoat or equivocate. He tells it like it is-a dose of raw, refreshing, honest truth that is sorel', 14),
(3, 'Brain Rules', 'John Medina', 8, 72, 'Available', 1, 'assets\\images\\Categorie\\Self Help\\brain rules.jpg', 'Presents twelve scientifically proven facts about how the human brain works and explains how to apply each on a daily basis, discussing such concepts as attention, memory, and sleep.', 20),
(4, 'The Happiness Hypothesis', 'JONATHAN HAIDT', 8, 172, 'Available', 1, 'assets\\images\\Categorie\\Self Help\\the happiness hypothesis.jpg\"', 'Happiness comes from within. But are these \'\'truths\'\' really true? Today we all seem to prefer to cling to the notion that a little bit more money, love or success will make us truly happy. Are we wrong? In The Happiness Hypothesis , psychologist Jonathan Haidt exposes traditional wisdom to the scrutiny of modern science, delivering startling insights. We learn that virtue is often not its own reward, why extroverts really are happier than introverts, and why conscious thought is not as importan', 9),
(5, 'BLUE OCEAN STRATEGY, EXPANDED EDITION - HOW TO CREATE UNCONTESTED MARKET SPACE AND MAKE THE COMPETITION', 'W Chan Mauborgne Kim', 4, 118, 'Available', 1, 'assets\\images\\Categorie\\Business\\Blue Ocean Strategy.jpg', 'An expanded edition of an internationally best-selling guide to creating profitable growth argues against common competitive practices while outlining recommendations based on the creation of untapped market spaces with growth potential. An international best-seller. 100,000 first printing.', 49),
(6, 'The 100$ Startup ', 'Chris Guillebeau', 4, 62, 'Available', 1, 'assets\\images\\Categorie\\Business\\the 100$ startup.jpg', 'Change your job to change your life.You no longer need to work nine-to-five in a big company to pay the mortgage, send your kids to school and afford that yearly holiday. You can quit the rat race and start up on your own - and you don\'t need an MBA or a huge investment to do it. The $100 Startup by Chris Guillebeau is your manual to a new way of living. Learn how to: - Earn a good living on your own terms, when and where you want - Achieve that perfect blend of passion and income to make work s', 60),
(7, 'Good to Great', 'Jim Collins', 4, 120, 'Available', 1, 'assets\\images\\Categorie\\Business\\Good to Great.jpg', 'This text attempts to show how a \"good\" company can become a \"great\" company. It looks at the type of leadership required, the one thing a company must focus on, the correct uses of technology, and how to make the changes last.\r\n', 30),
(8, 'ZERO TO ONE', 'MASTERS, BLAKE,THIEL, PETER', 4, 49, 'Available', 1, 'assets\\images\\Categorie\\Business\\zero to one.jpg', 'WHAT VALUABLE COMPANY IS NOBODY BUILDING?\r\n\r\nThe next Bill Gates will not build an operating system. The next Larry Page or Sergey Brin won\'t make a search engine. If you are copying these guys, you aren\'t learning from them. It\'s easier to copy a model than to make something new: doing what we already know how to do takes the world from 1 to n, adding more of something familiar. Every new creation goes from 0 to 1. This book is about how to get there.', 39),
(9, 'The fault in our stars', 'John Green', 9, 42, 'Available', 1, 'assets\\images\\Categorie\\Bookish Movies\\the fault in our stars.jpg', 'Despite the tumor-shrinking medical miracle that has bought her a few years, Hazel has never been anything but terminal, her final chapter inscribed upon diagnosis. But when a gorgeous plot twist named Augustus Waters suddenly appears at Cancer Kid Support Group, Hazel\'s story is about to be completely rewritten.\r\n', 20),
(10, 'All the bright places', 'Jennifer Niven', 9, 42, 'Available', 1, 'assets\\images\\Categorie\\Bookish Movies\\all the bright places.jpg', 'Theodore Finch is fascinated by death, and he constantly thinks of ways he might kill himself. But each time, something good, no matter how small, stops him. Violet Markey lives for the future, counting the days until graduation, when she can escape her Indiana town and her aching grief in the wake of her sister\'s recent death.', 30),
(11, 'The Great Gatsby', 'F. Scott Fitzgerald', 9, 70, 'Available', 1, 'assets\\images\\Categorie\\Bookish Movies\\the great gatsby.jpg', 'The Great Gatsby lives mysteriously in a luxurious Long Island mansion, playing lavish host to hundreds of people. And yet no one seems to know him or how he became so rich. He is rumoured to be everything from a German spy to a war hero. People clamour for invitations to his wild parties. But Jay Gatsby doesn\'t heed them. He cares for one person alone - Daisy Buchanan, the woman he has waited for all his life. Little does he know that his infatuation will lead to tragedy and end in murder.', 40),
(12, 'The queen\'s gambit', 'Walter Trevis', 9, 60, 'Available', 1, 'assets\\images\\Categorie\\Bookish Movies\\the queen of gambit.jpg', 'When she is sent to an orphanage at the age of eight, Beth Harmon soon discovers two ways to escape her surroundings, albeit fleetingly: playing chess and taking the little green pills given to her and the other children to keep them subdued. Before long, it becomes apparent that hers is a prodigious talent, and as she progresses to the top of the US chess rankings she is able to forge a new life for herself. But she can never quite overcome her urge to self-destruct. For Beth, there\'s more at s', 40),
(13, 'Ce que le jour doit à la nuit', 'Yasmina Khadra', 7, 34, 'Available', 1, 'assets\\images\\Categorie\\Novels\\ce-que-le-jour-doit-à-la-nuit.jpg', 'Algérie, années 1930. Les champs de blés frissonnent. Dans trois jours, les moissons, le salut. Mais une triste nuit vient consumer l\'espoir. Le feu. Les cendres. Pour la première fois, le jeune Younes voit pleurer son père.\r\nConfié à un oncle pharmacien, dans un village de l\'Oranais, le jeune garçon s\'intègre à la communauté pied-noire. Noue des amitiés indissolubles. Et le bonheur s\'appelle Émilie, une « princesse » que les jeunes gens se disputent. Alors que l\'Algérie coloniale vit ses dernie', 25),
(14, '1984', 'George Orwell', 7, 37, 'Available', 1, 'assets\\images\\Categorie\\Novels\\1984.jpg', ' Winston ne saurait en jurer. Le passé a été réinventé, Winston est lui-même chargé de récrire les archives qui contredisent le présent et les promesses de Big Brother. Grâce à une technologie de pointe, ce dernier sait tout, voit tout, connait les pensées de tout le monde. On ne peut se fier à personne et les enfants sont encore les meilleurs espions qui soient. Liberté est Servitude. Ignorance est Puissance. Telles sont les devises du régime de Big Brother. La plupart des Océaniens n\'y voient ', 30),
(15, 'Chanson douce', 'Leïla Slimani', 7, 32, 'Available', 1, 'assets\\images\\Categorie\\Novels\\chanson-douce.jpg', 'Lorsque Myriam, mère de deux jeunes enfants, décide malgré les réticences de son mari de reprendre son activité au sein d\'un cabinet d\'avocats, le couple se met à la recherche d\'une nounou. Après un casting sévère, ils engagent Louise, qui conquiert très vite l\'affection des enfants et occupe progressivement une place centrale dans le foyer. Peu à peu le piège de la dépendance mutuelle va se refermer, jusqu\'au drame.', 34),
(16, 'LE PRIX DU CINQUIEME JOUR', 'HOSNI KHAOULA', 7, 80, 'Available', 1, 'assets\\images\\Categorie\\Novels\\le-prix-du-cinquième-jour.jpg', 'Ghalia\'s life is complicated at the moment. Very complicated. Finding out that her husband is cheating on her is just too much news. After eighteen years of marriage, she doesn\'t even know how to react to this situation... Until Wafa, her husband\'s mistress, offers her a solution that could solve everything. Or complicate everything further.', 40),
(17, 'Leonardo da Vinci', 'WALTER ISAACSON', 3, 316, 'Available', 1, 'assets\\images\\Categorie\\biography\\Leonardo da Vinci.jpg', 'The narrative explores Leonardo\'s wide-ranging interests, from anatomy and fossils to flying machines and theatrical productions. Isaacson highlights how Leonardo\'s genius was fueled by a blend of passionate curiosity, meticulous observation, and a playful imagination. The biography unveils the secrets within Leonardo\'s notebooks and emphasizes the interconnectedness of his art and science, making it a captivating journey through the mind of history\'s most creative genius.', 30),
(18, 'Educated', 'Tara Westover', 3, 51, 'Available', 1, 'assets\\images\\Categorie\\biography\\Educated.jpg', 'With the acute insight that distinguishes all great writers, from her singular experience Westover has crafted a universal coming-of-age story that gets to the heart of what an education is and what it offers: the perspective to see one\'s life through new eyes, and the will to change it.', 15),
(19, 'A beautiful mind', 'Sylvia Nasar', 3, 70, 'Available', 1, 'assets\\images\\Categorie\\biography\\A Beautiful Mind.jpeg', 'The life story of an extraordinary mathematical genius - John Nash - who became schizophrenic, entered remission, and won the Nobel Prize. Nash was only 21 years old and at Princeton University when he invented game theory, the most influential theory of rational human behaviour of our time.', 20),
(20, 'Long Walk To Freedom', 'Nelson Mandela', 3, 86, 'Available', 1, 'assets\\images\\Categorie\\biography\\Long Walk to Freedom.jpg', 'The memoirs of the moral and political leader, Nelson Mandela, recreating the drama of the experiences that helped shape his destiny. It is a story of hardship, resilience and ultimate triumph.', 40),
(21, 'The Predator', 'Runyx', 1, 50, 'Available', 1, 'assets\\images\\Highlight\\The predator.jpg', 'In the dark underbelly of the mob, Tristan Caine has been an anomaly. As the only non-blooded member in the high circle of the Tenebrae Outfit, he is an enigma to all - his skills unparalleled, his morality questionable, and his motives unknown. He is lethal and he knows it.', 20),
(22, 'Hooked', 'Nir Eyal', 1, 80, 'Available', 1, 'assets\\images\\Highlight\\Hooked.jpg', 'How companies create products we can\'t live without - and how we too can create products that are addictive.', 4),
(23, 'Way Of The Wolf', 'Jordan Belfort', 1, 86, 'Available', 1, 'assets\\images\\Highlight\\way of the wolf.jpg', 'LEARN FROM THE MASTER OF SALES AND PERSUASION. At last Jordan Belfort - The Wolf of Wall Street - reveals how to use the Straight Line System - the proven technique for generating wealth which turned Wall Street upside down.', 20),
(24, 'Beach Read', 'Henry Emily', 1, 208, 'Available', 1, 'assets\\images\\Highlight\\Beach read.jpg', 'A breath of fresh airsteamy, smart, and perceptive.--Josie Silver, author of One Day in December A romance writer who no longer believes in love and a literary writer stuck in a rut engage in a summer-long challenge that may just upend everything they believe about happily ever afters.', 9),
(25, 'The Odyssey', 'Robert Fagles ', 6, 71, 'Available', 1, 'assets\\images\\Categorie\\Poetry\\The Odyssey.jpg\"', 'The great epic of Western literature, translated by the acclaimed classicist Robert Fagles A Penguin Classic Robert Fagles, winner of the PEN/Ralph Manheim Medal for Translation and a 1996 Academy Award in Literature from the American Academy of Arts and Letters, presents us with Homer\'s best-loved and most accessible poem in a stunning modern-verse translation. \r\n', 10),
(26, 'LEAVES OF GRASS', 'Walt Whitman', 6, 66, 'Available', 1, 'assets\\images\\Categorie\\Poetry\\Leaves of Grass.jpg', 'Leaves of Grass is Walt Whitman\'s glorious poetry collection, first published in 1855, which he revised and expanded throughout his lifetime. It was ground-breaking in its subject matter and in its direct, unembellished style. Part of the Macmillan Collector\'s Library; a series of stunning, clothbound, pocket sized classics with gold foiled edges and ribbon markers. ', 15),
(27, 'Milk And Honey', 'Rupi Kaur', 6, 68, 'Available', 1, 'assets\\images\\Categorie\\Poetry\\Milk and Honey.jpg', 'Built around short prose poems, Milk and Honey is about survival.\r\nAbout the experience of violence, sexual abuse, love, loss and femininity.\r\nThe collection includes four chapters, and each obeys a different motivation, treats a different suffering, heals a different pain.', 10),
(28, 'The Divine Comedy', 'Dante alighieri', 6, 80, 'Available', 1, 'assets\\images\\Categorie\\Poetry\\The Divine Comedy.jpeg', 'Describing Dante\'s descent into Hell midway through his life with Virgil as a guide, Inferno depicts a cruel underworld in which desperate figures are condemned to eternal damnation for committing one or more of seven deadly sins.', 23),
(29, 'Girl in pieces', 'Glasgow Kathleen', 2, 92, 'Available', 1, 'assets\\images\\New in store\\girl in pieces.jpg', 'Girl in Pieces is a deeply moving portrait of a teenager in a world that owes her nothing and has taken so much from her, and of the journey she takes to repair itself. Kathleen Glasgow\'s debut novel is heartbreakingly authentic and unflinchingly honest. A story we can\'t turn away from', 25),
(30, 'IT ENDS WITH US', 'Colleen Hoover', 2, 59, 'Available', 1, 'assets\\images\\New in store\\it ends with us.jpeg', ' Lily, a determined and hardworking woman, finds herself entangled in a seemingly perfect relationship with the assertive neurosurgeon, Ryle Kincaid. However, Ryle\'s aversion to commitment raises questions, and Lily is haunted by thoughts of her first love, Atlas Corrigan. As her past collides with her present, Lily is faced with challenging decisions that unravel the layers of her heart. Colleen Hoover crafts a brave and heartbreaking narrative that delves into the intricacies of relationships ', 20),
(31, 'The Love Hypothesis', 'Ali Hazelwood', 2, 80, 'Available', 1, 'assets\\images\\New in store\\the love hypothesis.jpeg', '\"Written in the Stars\" is a delightful romantic comedy that cleverly blends intelligence with escapism. Olive Smith, a skeptical third-year doctoral student, concocts a hypothesis about love, leading her to a fake relationship with the attractive and tyrannical Stanford professor, Adam Carlsen. As they navigate the complexities of their experiment, Olive discovers that testing hypotheses about love can be perilous when her own heart becomes the subject. Ali Hazelwood weaves a charming narrative ', 40),
(32, 'Little women ', 'Louisa May Alcott', 2, 24, 'Available', 1, 'assets\\images\\New in store\\Little Women.jpeg', 'Follows the four March sisters - pretty Meg, tomboy Jo, shy Beth and vain Amy - as they grow and mature into four distinctive little women. Louisa May Alcott was born in Pennsylvania and grew up in Boston and Concord, Massachusetts, the setting for Little Women.', 10),
(33, 'The Diary of a Young Girl', 'Anne Frank', 5, 118, 'Available', 1, 'assets\\images\\Categorie\\History\\The Diary of a Young Girl.jpg', 'In July 1942, thirteen-year-old Anne Frank and her family, fleeing the horrors of Nazi occupation, went into hiding in an Amsterdam warehouse. Over the next two years Anne vividly describes not only the daily frustrations of living in such close quarters, but also her thoughts, feelings and longings as she grows up. Her diary ends abruptly and tragically when, in August 1944, Anne and her family were all finally betrayed. The Diary of a Young Girl by Anne Frank remains the single most poignant s', 30),
(34, 'Magie Et Sacre De L\'Odeur', 'Nacef Nakbi', 5, 180, 'Available', 1, 'assets\\images\\Categorie\\History\\magie-et-sacre-de-l-odeur.jpg', '\r\nThis book is a comprehensive study of the incense tradition in Southern Tunisia, expanding its scope nationwide for a thorough ethnographic exploration. It contributes significantly to the ethnopsychology of ritualistic scents in Tunisia, covering various aspects such as osmological substances, hypercomplex systemology of ritual scents, and a detailed inventory of thurible systems and rites. The study offers an olfactory perspective on the daily lives and significant events of the people.', 20),
(35, 'Terres promises', ' ALFONSO CAMPISI', 5, 20, 'Available', 1, 'assets\\images\\Categorie\\History\\terres-promises.jpg', 'In times past, the Borsellino, Campo, Giacalone, Gandolfo, Garsia, Strazzea, Campisi, Caruso, and others migrated to Tunisia, bringing their skills as masons, carpenters, farmers, and fishermen. Through hard work, they built entire neighborhoods known as \"Little Sicily\" across the country, integrating seamlessly into the local population. Simultaneously, thousands of Sicilians ventured to Argentina and North America, establishing communities in places like Brucculino (Brooklyn), Tampa, and Detro', 5),
(36, 'The Guns of August', 'Barbara Tuchman', 5, 52, 'Available', 1, 'assets\\images\\Categorie\\History\\The Guns of August.jpg', 'Barbara Tuchman\'s \"The Guns of August\" is a captivating exploration of the first month of World War I, focusing on Britain\'s entry into the conflict. Tuchman adeptly depicts the escalating war across all frontiers and the governments\' struggles to prevent it. The Pulitzer Prize-winning classic is acclaimed for its vivid portrayal of brutal battles and the compelling logic that shaped the war\'s outset, earning praise from critics such as Max Hastings, The Guardian, and The New York Times for its ', 20),
(38, 'The hating game', 'Sally Thorne', 1, 30, 'Available', 7, 'assets\\images\\Highlight\\The hating game.jpg', 'The Hating Game\" by Sally Thorne is a witty romantic comedy centered on Lucy Hutton and Joshua Templeman, coworkers with a love-hate dynamic at a publishing house. As they engage in office games and pranks, their rivalry transforms into a complex and passionate romance, exploring themes of attraction and workplace dynamics. The novel is celebrated for its humor, sharp dialogue, and slow-burning love story.', 12);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Highlight'),
(2, 'New in store'),
(3, 'Biography'),
(4, 'Business'),
(5, 'History'),
(6, 'Poetry'),
(7, 'Novels'),
(8, 'Self Help'),
(9, 'Bookish Movies');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`commande_id`),
  KEY `userConstraint` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`commande_id`, `user_id`, `status`) VALUES
(13, 8, 'Rembourse'),
(15, 8, 'traitement'),
(16, 8, 'traitement'),
(17, 8, 'traitement'),
(18, 8, 'traitement'),
(20, 8, 'Refunded'),
(22, 6, 'traitement'),
(23, 6, 'traitement');

-- --------------------------------------------------------

--
-- Table structure for table `commande_details`
--

DROP TABLE IF EXISTS `commande_details`;
CREATE TABLE IF NOT EXISTS `commande_details` (
  `id_cd` int NOT NULL AUTO_INCREMENT,
  `commande_id` int NOT NULL,
  `book_id` int NOT NULL,
  `qte` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`id_cd`),
  KEY `CClient` (`client_id`),
  KEY `commandeConstraint` (`commande_id`),
  KEY `bookConstraint` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commande_details`
--

INSERT INTO `commande_details` (`id_cd`, `commande_id`, `book_id`, `qte`, `client_id`) VALUES
(92, 13, 24, 1, 8),
(94, 15, 2, 1, 8),
(95, 16, 2, 1, 8),
(96, 17, 9, 1, 8),
(97, 18, 6, 1, 8),
(99, 20, 15, 1, 8),
(100, 22, 6, 1, 6),
(101, 15, 31, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message` varchar(9999) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`) VALUES
(34, 'Houssm Dammak', 'houssemdammak2001@gmail.com', 'Book from archive', 'I want a book named jehedh'),
(35, 'Faiez Dammak', 'houssemdammak2001@gmail.com', 'Hello', 'I really love your book');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `promotion_id` int NOT NULL AUTO_INCREMENT,
  `promo_name` varchar(255) NOT NULL,
  `discount` float NOT NULL,
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `promo_name`, `discount`) VALUES
(1, 'Black Friday', 40),
(2, 'Spring Promo', 10),
(3, 'Weekend Special Offer', 15),
(4, 'Fall Clearance', 30),
(5, 'History Books Discount', 10),
(6, 'Student Discount', 25),
(7, 'World Book Day', 50),
(8, 'No Promotion', 0),
(11, 'Anniversary', 70);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nom`) VALUES
(0, 'traitement'),
(0, 'Rembourse');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `fullname`) VALUES
(1, 'yasmineghorbel29@gmail.com', '$2y$10$nBrRdeBvvG1Zp2kFGSTGYODnLv57rVLBOwdH4svmkks9wNNdFw/X6', 'yasmine ghorbel '),
(6, 'houssemdammak2001@gmail.com', '$2y$10$Wd9dkZbeIWfYin9V1x.Mp.31aIAnbo/QBIP9TJMAWdbFXAh54E3uq', 'houssem dammak '),
(8, 'admin@gmail.com', '$2y$10$A9vPO0kdIUtLPyLBo4maCOsgLv7BKZ9xWEtpNi/4WNBzZSf1tgqfC', 'admin'),
(18, 'lamiamaazoun@gmail.com', '$2y$10$iUFIwKqD0M3YMdLa4vitmuQZBYXkND.8q/sSoD03rDqOhjiKDEepm', 'lamia maazoun'),
(19, 'asmabahri@gmail.com', '$2y$10$/g.nbuSeSqpjSMktpesR9.fxPYfF2fBK5bBv1G1.agfLMvFZKDCZK', 'asma bahri'),
(30, 'yasminedammak29@gmail.com', '$2y$10$l/xmikfhjjy2iYMpwIr6fOrANzY5vsPTLr0.kGhyhXJ2o2LXMz5cW', 'yasmine  dammak');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `categoryConstraint` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `promotionConstraint` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`promotion_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `userConstraint` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `commande_details`
--
ALTER TABLE `commande_details`
  ADD CONSTRAINT `bookConstraint` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `CClient` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `clientConstraint` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commandeConstraint` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
