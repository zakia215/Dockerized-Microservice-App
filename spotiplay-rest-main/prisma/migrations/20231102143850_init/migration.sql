/*
  Warnings:

  - You are about to drop the `Artist` table. If the table is not empty, all the data it contains will be lost.
  - You are about to drop the `MusicVideo` table. If the table is not empty, all the data it contains will be lost.

*/
-- DropForeignKey
ALTER TABLE "MusicVideo" DROP CONSTRAINT "MusicVideo_artist_id_fkey";

-- DropTable
DROP TABLE "Artist";

-- DropTable
DROP TABLE "MusicVideo";

-- CreateTable
CREATE TABLE "Podcast" (
    "podcast_id" SERIAL NOT NULL,
    "podcast_title" TEXT NOT NULL,
    "uploaded" TIMESTAMP(3) NOT NULL,
    "audio_file_path" TEXT NOT NULL,
    "streams" INTEGER NOT NULL,
    "author_id" INTEGER NOT NULL,

    CONSTRAINT "Podcast_pkey" PRIMARY KEY ("podcast_id")
);

-- CreateTable
CREATE TABLE "Reviewer" (
    "reviewer_id" SERIAL NOT NULL,
    "username" TEXT NOT NULL,
    "email" TEXT NOT NULL,
    "password" TEXT NOT NULL,
    "profile_picture" TEXT NOT NULL,

    CONSTRAINT "Reviewer_pkey" PRIMARY KEY ("reviewer_id")
);

-- CreateTable
CREATE TABLE "Review" (
    "writer_id" INTEGER NOT NULL,
    "podcast_id" INTEGER NOT NULL,
    "review" TEXT NOT NULL,
    "rating" INTEGER NOT NULL,

    CONSTRAINT "Review_pkey" PRIMARY KEY ("writer_id","podcast_id")
);

-- CreateTable
CREATE TABLE "Podcaster" (
    "podcaster_id" SERIAL NOT NULL,
    "username" TEXT NOT NULL,
    "email" TEXT NOT NULL,
    "password" TEXT NOT NULL,
    "profile_picture" TEXT NOT NULL,

    CONSTRAINT "Podcaster_pkey" PRIMARY KEY ("podcaster_id")
);

-- CreateIndex
CREATE UNIQUE INDEX "Podcaster_username_email_key" ON "Podcaster"("username", "email");

-- AddForeignKey
ALTER TABLE "Podcast" ADD CONSTRAINT "Podcast_author_id_fkey" FOREIGN KEY ("author_id") REFERENCES "Podcaster"("podcaster_id") ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "Review" ADD CONSTRAINT "Review_writer_id_fkey" FOREIGN KEY ("writer_id") REFERENCES "Reviewer"("reviewer_id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "Review" ADD CONSTRAINT "Review_podcast_id_fkey" FOREIGN KEY ("podcast_id") REFERENCES "Podcast"("podcast_id") ON DELETE RESTRICT ON UPDATE CASCADE;
