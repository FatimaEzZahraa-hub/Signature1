
# 📁 Guide de collaboration Git - Projet de stage

## 👥 Membres
- Fatima (PC Dell)
- Amal (PC HP)

---

## 🔧 1. Clonage du projet (pour Amal)

💡 Comme vous travaillez sur deux ordinateurs différents, Amal doit cloner le projet depuis GitHub :

```bash
git clone https://github.com/FatimaEzZahraa-hub/Signature1.git
cd Signature1
```

---

## 🌿 2. Création d'une branche personnelle

Chacun doit créer sa propre branche de travail :

```bash
# Pour Fatima
git checkout -b dev-Fatima

# Pour Amal
git checkout -b dev-Amal
```

---

## 💻 3. Ajouter et pousser ses modifications

```bash
git add .
git commit -m "Message clair"
git push origin dev-Fatima  # ou dev-Amal
```

---

## 🔄 4. Récupérer les dernières mises à jour du projet

Toujours avant de commencer à travailler ou avant de pousser :

```bash
git pull origin main
```

En cas de conflits, les résoudre puis refaire un commit.

---

## 🔀 5. Faire une Pull Request (PR)

Sur GitHub :
- Aller dans l’onglet **"Pull Requests"**
- Créer une PR de `dev-Fatima` ou `dev-Amal` vers `main`
- Demander une relecture
- Une fois validée, fusionner (merge)

---

## 🔁 6. Mettre à jour sa branche après un merge

```bash
git checkout main
git pull origin main

git checkout dev-Fatima  # ou dev-Amal
git merge main
```

---

✅ **Conseil :** committez souvent avec des messages clairs, restez synchronisés avec `main`, et communiquez avant de merger une PR.
