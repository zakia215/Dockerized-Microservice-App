# Spotiplay

Daftar Konten:
- [Spotiplay](#spotiplay)
  - [Deskripsi Aplikasi Web ](#deskripsi-aplikasi-web-)
  - [Daftar _Requirement_ ](#daftar-requirement-)
  - [Cara Instalasi ](#cara-instalasi-)
  - [Cara Menjalankan Server ](#cara-menjalankan-server-)
  - [Screenshot Tampilan Aplikasi ](#screenshot-tampilan-aplikasi-)
    - [Tambahan Layar Milestone 2](#tambahan-layar-milestone-2)
  - [Pembagian Tugas ](#pembagian-tugas-)
    - [Server Side](#server-side)
    - [Client Side](#client-side)

## Deskripsi Aplikasi Web <a name="desc"></a>
Spotiplay merupakan aplikasi berbasis web dengan sumber ide pembuatan aplikasi berdasarkan aplikasi musik populer bernama Spotify. Spotiplay dibuat dengan menggunakan bahasa pemrograman PHP pada pihak server serta HTML, CSS, dan JavaScript pada pihak klien. Selain itu, digunakan Docker untuk meningkatkan kerja dan efisiensi aplikasi dan PostgreSQL sebagai basis data aplikasi.</br>

Spotiplay beserta repository ini dibuat dengan tujuan sebagai pemenuhan tugas besar _milestone_ 1 IF3110 Pengembangan Aplikasi Berbasis Web.</br>

Anggota kelompok:
<table>
  <tr>
    <td align="center" colspan="3">No. Kelompok : 30</td>
  </tr>   
  <tr>
    <td align="center">NIM</td>
    <td align="center">Nama</td>
    <td align="center">Username</td>
  </tr>
  <tr>
    <td align="center">13521076</td>
    <td align="center">Moh. Aghna Maysan Abyan</td>
    <td align="center"><a href=https://gitlab.informatika.org/AghnaAbyan>AghnaAbyan</a></td>
  </tr>
    <tr>
    <td align="center">13521146</td>
    <td align="center">Muhammad Zaki Amanullah</td>
    <td align="center"><a href=https://gitlab.informatika.org/ZakiAmanullah>ZakiAmanullah</a></td>
  </tr>
  <tr>
    <td align="center">13521155</td>
    <td align="center">Kandida Edgina Gunawan</td>
    <td align="center"><a href=https://gitlab.informatika.org/kandidagunawan>kandidagunawan</a></td>
  </tr>
</table>

## Daftar _Requirement_ <a name="req"></a>
Daftar kebutuhan yang perlu diunduh oleh pengguna supaya program Spotiplay dapat berjalan adalah:

1. Docker
2. Repository Spotiplay


## Cara Instalasi <a name="install"></a>
Langkah instalasi Spotiplay supaya aplikasi dapat digunakan oleh pengguna pada perangkat pengguna adalah:

1. Lakukan instalasi Docker melalui website https://www.docker.com/get-started/ lalu ikuti langkah-langkahnya.
2. Lakukan kloning repository Spotiplay.
```bash
git clone https://gitlab.informatika.org/if3110-2023-k01-01-30/tugas-besar-1.git
```

## Cara Menjalankan Server <a name="server"></a>
1. Pindah ke root folder repository
2. Buat .env file
3. Build docker image
```bash
docker build -t
```
4. Buat dan jalankan docker container
```bash
docker-compose up -d
```


## Screenshot Tampilan Aplikasi <a name="screen"></a>
|![Alt text](/public/img/screenshots/landing_page.png)|
|:--:| 
| *Landing Page* |

|![Alt text](/public/img/screenshots/signup.png)|
|:--:| 
| *Signup* |

|![Alt text](/public/img/screenshots/login.png)|
|:--:| 
| *Login* |

|![Alt text](/public/img/screenshots/profile.png)|
|:--:| 
| *Profile* |

|![Alt text](/public/img/screenshots/edit_profile.png)|
|:--:| 
| *Edit Profile* |

|![Alt text](/public/img/screenshots/browse.png)|
|:--:| 
| *Browse* |

|![Alt text](/public/img/screenshots/browse_song.png)|
|:--:| 
| *Browse Song* |

|![Alt text](/public/img/screenshots/browse_artist.png)|
|:--:| 
| *Browse Artist* |

|![Alt text](/public/img/screenshots/browse_album.png)|
|:--:| 
| *Browse Album* |

|![Alt text](/public/img/screenshots/listen_now.png)|
|:--:| 
| *Listen Now* |

### Tambahan Layar Milestone 2

|![Alt text](/public/img/screenshots/listen_podcast.png)|
|:--:| 
| *Listen to Podcast* |

|![Alt text](/public/img/screenshots/all_podcasters.png)|
|:--:| 
| *Display all available podcasters* |

|![Alt text](/public/img/screenshots/podcasters_podcast.png)|
|:--:| 
| *Podcaster's Podcast* |

|![Alt text](/public/img/screenshots/subscribed_podcasters.png)|
|:--:| 
| *Subscribed Podcasters* |


## Pembagian Tugas <a name="assign"></a>

### Server Side
<table>
  <tr>
    <td align="center">Bagian</td>
    <td align="center">NIM</td>
  </tr>
  <tr>
    <td align="center">Login</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Register</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Landing Page</td>
    <td align="center">13521146</td>
  </tr>
    <tr>
    <td align="center">Storage</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Listen Now</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">List of Songs</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Database</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Edit Artist</td>
    <td align="center">13521146, 13521076</td>
  </tr>
  <tr>
    <td align="center">Edit Album</td>
    <td align="center">13521146, 13521076</td>
  </tr>
  <tr>
    <td align="center">Edit Song</td>
    <td align="center">13521146, 13521076</td>
  </tr>
  <tr>
    <td align="center">Add Artist</td>
    <td align="center">13521155, 13521076</td>
  </tr>
  <tr>
    <td align="center">Add Album</td>
    <td align="center">13521155, 13521076</td>
  </tr>
  <tr>
    <td align="center">Add Song</td>
    <td align="center">13521155, 13521076</td>
  </tr>
  <tr>
    <td align="center">Navbar</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">List of Artists</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">List of Album</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">Docker</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">Adding Subscription Callback API</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Adding Subscription Callback API</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Connecting to SOAP API</td>
    <td align="center">13521146, 13521155</td>
  </tr>
  <tr>
    <td align="center">Connecting to REST API</td>
    <td align="center">13521155</td>
  </tr>
  
</table>

### Client Side
<table>
  <tr>
    <td align="center">Bagian</td>
    <td align="center">NIM</td>
  </tr>
  <tr>
    <td align="center">Listen Now</td>
    <td align="center">13521076</td>
  </tr>
    <tr>
    <td align="center">Login</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Register</td>
    <td align="center">13521146</td>
  </tr>
    <tr>
    <td align="center">List of Songs</td>
    <td align="center">13521146</td>
  </tr>
    <tr>
    <td align="center">Navbar</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">List of Artists</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">List of Album</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">All Podcasters Page</td>
    <td align="center">13521155, 13521076</td>
  </tr>
  <tr>
    <td align="center">Subscribed Podcasters</td>
    <td align="center">13521146</td>
  </tr>
  <tr>
    <td align="center">Podcaster's Podcasts</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">Listen Now (Podcasts)</td>
    <td align="center">13521155</td>
  </tr>
  <tr>
    <td align="center">Navbar Edit</td>
    <td align="center">13521155</td>
  </tr>
</table>