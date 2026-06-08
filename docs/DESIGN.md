# Design Documentatie

Dit document beschrijft de designkeuzes, wireflows en usability evaluatie van het IT Development Portfolio.

## 1. Wireflows

De onderstaande wireflows beschrijven de belangrijkste gebruikersstromen binnen de applicatie.

### Flow A: Beheren van Bio (Owner/Editor)
1. **Dashboard:** Gebruiker klikt op "Bio beheren".
2. **Bio Edit Page:** Gebruiker vult headline, summary en andere details in.
3. **Action:** Gebruiker klikt op "Bio opslaan".
4. **Result:** Systeem valideert data, slaat op in DB en redirect terug met succesmelding.
5. **View:** Gebruiker kan via de link in de navigatie zijn publieke profiel bekijken.

### Flow B: Bijhouden Studievoortgang (Owner)
1. **Dashboard:** Gebruiker navigeert naar de sectie "Studievoortgang".
2. **Interactie:** Gebruiker vult EC-punten in een tekstveld in (bijv. "5").
3. **Background Action (Fetch):** Na 1 seconde inactiviteit wordt de data automatisch via een `POST` request naar `/study-results` verzonden.
4. **Feedback:** Een statusbericht "Opgeslagen in database" verschijnt kortstondig onder de tabel.
5. **Visual:** De progress bar bovenaan de tabel wordt direct bijgewerkt op basis van de ingevoerde waarden.

### Flow C: Blog Workflow (Owner/Editor)
1. **Posts Index:** Gebruiker ziet overzicht van eigen posts.
2. **Create Post:** Gebruiker klikt op "Nieuwe post".
3. **Editor:** Gebruiker schrijft titel en inhoud.
4. **Publish:** Gebruiker kiest status (concept/gepubliceerd).
5. **Result:** Gepubliceerde posts zijn zichtbaar voor bezoekers.

---

## 2. Nielsen Heuristics Evaluatie

De applicatie is getoetst aan de 10 usability heuristics van Jakob Nielsen.

| Heuristics | Toepassing in Portfolio |
| :--- | :--- |
| **1. Visibility of system status** | De progress bar voor EC-punten geeft direct visuele feedback. Succesmeldingen verschijnen na het opslaan van de bio of posts. |
| **2. Match between system and real world** | Termen als "Dashboard", "Bio" en "EC" sluiten aan bij de belevingswereld van een student. |
| **3. User control and freedom** | Gebruikers kunnen posts bewerken of verwijderen. Er is een duidelijke "Cancel" of "Terug" optie op de meeste pagina's. |
| **4. Consistency and standards** | Gebruik van een consistente navigatiebalk bovenaan en een standaard layout (Tailwind UI patronen). |
| **5. Error prevention** | De EC-velden accepteren alleen numerieke invoer (gevalideerd via JS en backend). Verplichte velden in formulieren zijn gemarkeerd. |
| **6. Recognition rather than recall** | Recente posts worden direct op het dashboard getoond, zodat de gebruiker niet hoeft te zoeken naar zijn laatste werk. |
| **7. Flexibility and efficiency of use** | Sneltoetsen/links in het dashboard voor de meest voorkomende acties (Bio beheren, Nieuwe post). |
| **8. Aesthetic and minimalist design** | Clean interface met focus op inhoud. Geen overbodige visuele ruis. |
| **9. Help users recognize/recover from errors** | Validatiefouten (bijv. te korte tekst in een post) worden duidelijk in het rood boven het formulier getoond met specifieke instructies. |
| **10. Documentation and help** | Een "Quickstart" en "Architecture" gids zijn aanwezig in de `/docs` map voor beheerders/beoordelaars. |

---

## 3. Kleurenpalet & Typografie
*   **Primary:** Blue-600 (Acties, knoppen)
*   **Background:** Gray-100 (Neutrale achtergrond voor focus op kaarten)
*   **Text:** Gray-900 (Hoge leesbaarheid)
*   **Typography:** Sans-serif (Modern en zakelijk)
