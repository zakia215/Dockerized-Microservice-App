-- CreateTable
CREATE TABLE "Artist" (
    "artist_id" SERIAL NOT NULL,
    "username" TEXT NOT NULL,
    "email" TEXT NOT NULL,
    "password" TEXT NOT NULL,
    "name" TEXT NOT NULL,
    "profile_picture" TEXT NOT NULL,

    CONSTRAINT "Artist_pkey" PRIMARY KEY ("artist_id")
);

-- CreateTable
CREATE TABLE "MusicVideo" (
    "video_id" SERIAL NOT NULL,
    "file_path" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "artist_id" INTEGER NOT NULL,
    "views" INTEGER NOT NULL,

    CONSTRAINT "MusicVideo_pkey" PRIMARY KEY ("video_id")
);

-- AddForeignKey
ALTER TABLE "MusicVideo" ADD CONSTRAINT "MusicVideo_artist_id_fkey" FOREIGN KEY ("artist_id") REFERENCES "Artist"("artist_id") ON DELETE RESTRICT ON UPDATE CASCADE;
