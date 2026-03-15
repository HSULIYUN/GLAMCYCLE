# 💄 過期化妝品回收再利用平台 
> **"Turning Beauty Waste into Art"** — 一個致力於環保與公益的全端網頁系統，將過期化妝品轉化為繪畫顏料，捐贈給偏鄉兒童。

## 👨‍💻 關於我 (About Me)
我是本專案的 **全端開發者 (Full-Stack Developer)**。
在這個專案中，我負責從資料庫規劃、後端邏輯撰寫到前端介面設計的完整開發流程。

## 🛠️ 技術堆疊 (Tech Stack)
本專案堅持使用原生技術開發，以確保對底層運作原理的完全掌握：

* **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
* **Backend:** PHP (Native)
* **Database:** MySQL
* **Tools:** Visual Studio Code, XAMPP/WAMP

---

## ✨ 介面設計亮點 (UI/UX Highlights)
以下是我在設計與開發上最滿意的四個核心：

### 1. 🏠 網站首頁 (Homepage)
**"第一眼的視覺衝擊與資訊架構"**
首頁是使用者的第一站，我設計了動態的視覺引導，讓使用者能快速理解平台核心價值。
* **視覺設計：** 採用動畫方式呈現核心概念，增加互動趣味性。
* **資訊分層：** 清晰規劃了「最新資訊」、「6大特色介紹」與「品牌故事」區塊，讓資訊閱讀不費力。
* **直覺導航：** 頂部導航與醒目的登入/註冊入口，確保使用者流暢進入系統。
<img width="1473" height="781" alt="index" src="https://github.com/user-attachments/assets/b54df6ad-1280-4489-9b8e-a02ccab84e2e" />

### 2. 📅 活動系統 (Event Portal)
**"流暢的活動探索體驗"**
為了讓志工能方便參與回收與教學活動，我將活動資訊進行了模組化設計。
* **活動檢索：** 設計了依時間軸或主題的快速查詢功能，使用者不僅能看到近期活動，也能回顧精彩歷史。
* **卡片式設計：** 活動列表採用卡片式排版，重點資訊（日期、地點、主題）一目了然。
* **無縫報名：** 整合了「活動詳情」到「報名表單」的流程，減少頁面跳轉的斷裂感。
<img width="550" height="276" alt="event" src="https://github.com/user-attachments/assets/86d49813-3d31-4624-80f1-4922dff79da5" />

### 3. 👤 會員管理中心 (Member System)
**"安全與個人化的後台"**
會員系統是整個平台的基石，我專注於資料的安全防護與操作的便利性。
* **雙區塊登入/註冊：** 設計了清晰的登入與註冊切換介面，避免使用者混淆。
* **個人儀表板：** 會員可輕鬆管理個人資料（姓名、Email、電話、生日），並能隨時查看參與紀錄。
* **安全驗證：** 實作了嚴格的表單驗證機制（如 Email 格式檢查、必填欄位防呆），確保資料庫數據的準確性。
<img width="1474" height="790" alt="member" src="https://github.com/user-attachments/assets/d7cdfc98-b96b-4ebe-9b4b-08888bfa5ae9" />


---

## 🚀 如何執行 (Installation)

1.  Clone 此專案到本地端：
    ```bash
    git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
    ```
2.  將專案資料夾放入 Web Server 目錄 (如 XAMPP 的 `htdocs`)。
3.  匯入資料庫：
    * 開啟 phpMyAdmin。
    * 建立新資料庫 `cosmetic_recycle` (或依專案設定)。
    * 匯入 `database.sql` 檔。
4.  設定資料庫連線：
    * 開啟 `db_connection.php` (或相關設定檔)。
    * 修改 Host, Username, Password。
5.  開啟瀏覽器訪問 `localhost/your-repo-name`。


