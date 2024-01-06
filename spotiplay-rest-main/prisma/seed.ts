import { PrismaClient } from "@prisma/client"

const prisma = new PrismaClient()

const podcasterData = [
    {
        name: "The Tiny Meat Gang Podcast",
        cover_art: "https://i.scdn.co/image/ab6761610000e5ebd4b9b8b4b2b4b2b4b2b4b2b4",
        description: "Comedians Cody Ko and Noel Miller make you laugh, hopefully. Bonus eps on Patreon.",
        username: "tmg",
        email: "tmg@gmail.com",
        password: "tmg"
    },
    {
        name: "Bad Friends",
        cover_art: "https://i.scdn.co/image/ab6761610000e5ebd4b9b8b4b2b4b2b4b2b4b2b4",
        description: "Andrew Santino and Bobby Lee present BAD FRIENDS. New episodes every Monday!",
        username: "badfriends",
        email: "badfriends@gmail.com",
        password: "badfriends"
    },
    {
        name: "The Fighter & The Kid",
        cover_art: "https://i.scdn.co/image/ab6761610000e5ebd4b9b8b4b2b4b2b4b2b4b2b4",
        description: "Comedians Bryan Callen and Brendan Schaub bring you the biggest podcast in the world.",
        username: "tfatk",
        email: "tfatk@gmail.com",
        password: "tfatk"
    },
    {
        name: "Another Podcast",
        cover_art: "https://i.scdn.co/image/ab6761610000e5ebd4b9b8b4b2b4b2b4b2b4b2b4",
        description: "A podcast about something",
        username: "anotherpodcast",
        email: "anotherpodcast@gmail.com",
        password: "anotherpodcast"
    },
    {
        podcaster_id: 7,
        name: "Podcast Example",
        cover_art: "http://localhost:3000/img/file-1699778076768-561738447.jpg",
        description: "Lorem ipsum dolor si amet",
        username: "podcaskualitastinggi",
        email: "podcastexample@gmail.com",
        password: "$2a$10$2NX6LLTVqxcZuln68COOMubbz9edXna7.B/6sRtwuUx1gHa9Zf0HW"
    }

]

// async function main() {
//     const jre = await prisma.podcaster.createMany({
//         data: podcasterData,
//     });
//     console.log({ jre })
// }

async function main() {
    for (const podcaster of podcasterData) {
        const createdPodcaster = await prisma.podcaster.create({
            data: podcaster,
        });
        console.log(`Created podcaster with id: ${createdPodcaster.podcaster_id}`);
    }
    const joeRoganPodcasts = [
        {
            podcast_title: "Joe Rogan Experience #1 - Brian Redban",
            podcast_desc: "Joe Rogan and Brian Redban talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-01T00:00:00Z"),
            audio_file_path: "https://example.com/jre1.mp3",
            streams: 1000000,
            cover_art: "https://example.com/jre1.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #2 - Joey Diaz",
            podcast_desc: "Joe Rogan and Joey Diaz talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-02T00:00:00Z"),
            audio_file_path: "https://example.com/jre2.mp3",
            streams: 2000000,
            cover_art: "https://example.com/jre2.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #3 - Duncan Trussell",
            podcast_desc: "Joe Rogan and Duncan Trussell talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-03T00:00:00Z"),
            audio_file_path: "https://example.com/jre3.mp3",
            streams: 3000000,
            cover_art: "https://example.com/jre3.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #4 - Tom Segura",
            podcast_desc: "Joe Rogan and Tom Segura talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-04T00:00:00Z"),
            audio_file_path: "https://example.com/jre4.mp3",
            streams: 4000000,
            cover_art: "https://example.com/jre4.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #5 - Bert Kreischer",
            podcast_desc: "Joe Rogan and Bert Kreischer talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-05T00:00:00Z"),
            audio_file_path: "https://example.com/jre5.mp3",
            streams: 5000000,
            cover_art: "https://example.com/jre5.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #6 - Ari Shaffir",
            podcast_desc: "Joe Rogan and Ari Shaffir talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-06T00:00:00Z"),
            audio_file_path: "https://example.com/jre6.mp3",
            streams: 6000000,
            cover_art: "https://example.com/jre6.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #7 - Eddie Bravo",
            podcast_desc: "Joe Rogan and Eddie Bravo talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-07T00:00:00Z"),
            audio_file_path: "https://example.com/jre7.mp3",
            streams: 7000000,
            cover_art: "https://example.com/jre7.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #8 - Brendan Schaub",
            podcast_desc: "Joe Rogan and Brendan Schaub talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-08T00:00:00Z"),
            audio_file_path: "https://example.com/jre8.mp3",
            streams: 8000000,
            cover_art: "https://example.com/jre8.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #9 - Bill Burr",
            podcast_desc: "Joe Rogan and Bill Burr talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-09T00:00:00Z"),
            audio_file_path: "https://example.com/jre9.mp3",
            streams: 9000000,
            cover_art: "https://example.com/jre9.jpg",
            author_id: 1,
        },
        {
            podcast_title: "Joe Rogan Experience #10 - Elon Musk",
            podcast_desc: "Joe Rogan and Elon Musk talk about life, comedy, and everything in between.",
            uploaded: new Date("2021-10-10T00:00:00Z"),
            audio_file_path: "https://example.com/jre10.mp3",
            streams: 10000000,
            cover_art: "https://example.com/jre10.jpg",
            author_id: 1,
        },
    ]

    for (const podcast of joeRoganPodcasts) {
        const createdPodcast = await prisma.podcast.create({
            data: podcast,
        })
        console.log(`Created podcast with id: ${createdPodcast.podcast_id}`)
    }

    const reviewers = [
        {
            username: "reviewer1",
            email: "reviewer1@example.com",
            password: "password1",
            profile_picture: "https://example.com/reviewer1.jpg",
        },
        {
            username: "reviewer2",
            email: "reviewer2@example.com",
            password: "password2",
            profile_picture: "https://example.com/reviewer2.jpg",
        },
        {
            username: "reviewer3",
            email: "reviewer3@example.com",
            password: "password3",
            profile_picture: "https://example.com/reviewer3.jpg",
        },
        {
            username: "reviewer4",
            email: "reviewer4@example.com",
            password: "password4",
            profile_picture: "https://example.com/reviewer4.jpg",
        },
        {
            username: "reviewer5",
            email: "reviewer5@example.com",
            password: "password5",
            profile_picture: "https://example.com/reviewer5.jpg",
        },
        {
            username: "reviewer6",
            email: "reviewer6@example.com",
            password: "password6",
            profile_picture: "https://example.com/reviewer6.jpg",
        },
        {
            username: "reviewer7",
            email: "reviewer7@example.com",
            password: "password7",
            profile_picture: "https://example.com/reviewer7.jpg",
        },
        {
            username: "reviewer8",
            email: "reviewer8@example.com",
            password: "password8",
            profile_picture: "https://example.com/reviewer8.jpg",
        },
        {
            username: "reviewer9",
            email: "reviewer9@example.com",
            password: "password9",
            profile_picture: "https://example.com/reviewer9.jpg",
        },
        {
            username: "reviewer10",
            email: "reviewer10@example.com",
            password: "password10",
            profile_picture: "https://example.com/reviewer10.jpg",
        },
    ];

    for (const reviewer of reviewers) {
        const createdReviewer = await prisma.reviewer.create({
            data: reviewer,
        });
        console.log(`Created reviewer with id: ${createdReviewer.reviewer_id}`);
    }

    const reviews = [
        {
            writer_id: 1,
            podcast_id: 1,
            review: "This podcast was amazing!",
            rating: 5,
        },
        {
            writer_id: 2,
            podcast_id: 1,
            review: "I didn't really enjoy this podcast.",
            rating: 2,
        },
        {
            writer_id: 3,
            podcast_id: 1,
            review: "This podcast was okay.",
            rating: 3,
        },
        {
            writer_id: 4,
            podcast_id: 1,
            review: "I loved this podcast!",
            rating: 5,
        },
        {
            writer_id: 5,
            podcast_id: 1,
            review: "This podcast was terrible.",
            rating: 1,
        },
        {
            writer_id: 6,
            podcast_id: 2,
            review: "This podcast was amazing!",
            rating: 5,
        },
        {
            writer_id: 7,
            podcast_id: 2,
            review: "I didn't really enjoy this podcast.",
            rating: 2,
        },
        {
            writer_id: 8,
            podcast_id: 2,
            review: "This podcast was okay.",
            rating: 3,
        },
        {
            writer_id: 9,
            podcast_id: 2,
            review: "I loved this podcast!",
            rating: 5,
        },
        {
            writer_id: 10,
            podcast_id: 2,
            review: "This podcast was terrible.",
            rating: 1,
        },
    ];

    for (const review of reviews) {
        const createdReview = await prisma.review.create({
            data: review,
        });
        console.log(`Created review with writer_id: ${createdReview.writer_id} and podcast_id: ${createdReview.podcast_id}`);
    }
}


main()
    .then(async () => {
        await prisma.$disconnect()
    })
    .catch(async (e) => {
        console.log(e)
        await prisma.$disconnect()
        process.exit(1)
    })