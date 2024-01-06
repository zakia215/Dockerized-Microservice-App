/*
  Warnings:

  - Added the required column `cover_art` to the `Podcast` table without a default value. This is not possible if the table is not empty.
  - Added the required column `podcast_desc` to the `Podcast` table without a default value. This is not possible if the table is not empty.
  - Added the required column `cover_art` to the `Podcaster` table without a default value. This is not possible if the table is not empty.
  - Added the required column `description` to the `Podcaster` table without a default value. This is not possible if the table is not empty.
  - Added the required column `name` to the `Podcaster` table without a default value. This is not possible if the table is not empty.

*/
-- AlterTable
ALTER TABLE "Podcast" ADD COLUMN     "cover_art" TEXT NOT NULL,
ADD COLUMN     "podcast_desc" TEXT NOT NULL;

-- AlterTable
ALTER TABLE "Podcaster" ADD COLUMN     "cover_art" TEXT NOT NULL,
ADD COLUMN     "description" TEXT NOT NULL,
ADD COLUMN     "name" TEXT NOT NULL;
