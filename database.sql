
CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('xPRHsg5Aq2Gu99haUlGt', 'qHZsu6PNTDgkVFhigsef');

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `news_id` varchar(20) NOT NULL,
  `jobs_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jobs` (
  `id` varchar(20) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jobs` (`id`, `title`, `content`, `tutor_id`, `thumb`, `date`, `status`) VALUES
('RWNAxFisqfFjqfxsEL0C', 'ádfjhasdkfjhkadsfhkj', 'kayidufyiuweyouqiyeoiuqye', 'HgL5g7sZ94S5JwQeTjBz', 'k4gjOLXpYQYlaGuPKddu.png', '2024-05-26', 'active');


CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `news` (
  `id` varchar(20) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `news` (`id`, `title`, `content`, `tutor_id`, `thumb`, `date`, `status`) VALUES
('dy4u3GVCKrtL3f26GHlY', 'adfhagsdfjhkj', 'ládlfjlaksdjflkajsdlkf', 'HgL5g7sZ94S5JwQeTjBz', 'nMmbdhJvGMJwB3ioLY0Q.png', '2024-05-26', 'active');

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `playlist` (`id`, `tutor_id`, `title`, `description`, `thumb`, `date`, `status`) VALUES
('qHZsu6PNTDgkVFhigsef', 'HgL5g7sZ94S5JwQeTjBz', 'Genshin Impact - Liyue Disc', 'This is the playlist of all the songs in Liyue', 'ytykWTd24FuVMahDGJwS.jpg', '2024-05-20', 'active'),
('dGwbxwh33rKlpeRAxt6f', 'HgL5g7sZ94S5JwQeTjBz', 'Arlecchino', 'This is Arlecchino gameplay in Genshin Impact', 'wNLTs6Pa9fsDl0EGqepS.png', '2024-05-25', 'active');

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
('HgL5g7sZ94S5JwQeTjBz', 'Sơn Lê', 'developer', 'bigpenis126@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'S8gZmXPcG1MtQqH8hpRi.png');

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('xPRHsg5Aq2Gu99haUlGt', 'Lê Ngọc Sơn', 'lengocson824@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'bwQZk41knDWDwrkj7MV7.png'),
('v0wbGpkWocmUoKPfiI6E', 'Sơn Lê', 'mokuyobi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'PC0dUskpsZlmTubC7nkX.png');
COMMIT;
