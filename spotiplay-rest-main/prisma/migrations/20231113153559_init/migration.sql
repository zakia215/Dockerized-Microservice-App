-- DropForeignKey
ALTER TABLE "Review" DROP CONSTRAINT "Review_podcast_id_fkey";

-- DropForeignKey
ALTER TABLE "Review" DROP CONSTRAINT "Review_writer_id_fkey";

-- AddForeignKey
ALTER TABLE "Review" ADD CONSTRAINT "Review_writer_id_fkey" FOREIGN KEY ("writer_id") REFERENCES "Reviewer"("reviewer_id") ON DELETE CASCADE ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "Review" ADD CONSTRAINT "Review_podcast_id_fkey" FOREIGN KEY ("podcast_id") REFERENCES "Podcast"("podcast_id") ON DELETE CASCADE ON UPDATE CASCADE;
