# Spotiplay SOAP

Daftar Konten:
- [Deskripsi Singkat Web Service](#desc)
- [Skema Basis Data](#db)
- [Endpoint API](#endpoint)
- [Pembagian Tugas ](#assign)

## Deskripsi Singkat Web Service <a name="desc"></a>

Web Service SOAP pada Spotiplay akan menangani (menerima/menolak) permintaan *subscription*. Service dibuat dengan JAX-WS JAVA SERVLET, MySQL, dan Docker.

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

## Skema Basis Data <a name="db"></a>
|![Alt text](/screenshot/subscription.png)|
|:--:|
| *Subscriptions* |

|![Alt text](/screenshot/logging.png)|
|:--:|
| *Logging* |

|![Alt text](/screenshot/foreignkeyandconstraint.png)
|:--:|
| *Foreign Key & Constraints* |

## Endpoint API <a name="endpoint"></a>
Berikut adalah *Endpoint* API yang digunakan pada SOAP program:
1. Subscription subscribe(int creator_id, int subscriber_id, String username)
2. Subscription acceptSubscription(int creator_id, int subscriber_id)
3. Subscription rejectSubscription(int creator_id, int subscriber_id)
4. List<Subscription> getSubscriptions()
5. List<Subscription> getSubscriptionsByCreatorId(int creator_id)
6. List<Subscription> getSubscriptionsBySubscriberId(int subscriber_id)
7. List<Subscription> getSubscriptionsByStatus(String status) 

## Pembagian Tugas <a name="assign"></a>
- Fungsi subscribe = 13521076
- Fungsi except subscription = 13521146
- Fungsi reject subscription = 13521155
- Fungsi get subscription by creator ID = 13521146
- Fungsi get subscription by subscriber ID = 13521146
- Fungsi get subscription by status = 13521146
- README.md SOAP = 13521076