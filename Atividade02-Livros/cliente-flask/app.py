import requests
from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)
API = "http://localhost:8000/api/livros"
HEADERS = {"Accept": "application/json"}


def buscar_livros():
    return requests.get(API, headers=HEADERS, timeout=10).json().get("data", [])


@app.route("/")
def listar():
    return render_template("livros.html", livros=buscar_livros(), erros=None)


@app.route("/livros", methods=["POST"])
def criar():
    payload = {
        "titulo": request.form["titulo"],
        "autor": request.form["autor"],
        "ano_publicacao": request.form.get("ano_publicacao") or None,
    }
    resp = requests.post(API, json=payload, headers=HEADERS, timeout=10)

    if resp.status_code == 422:
        return render_template("livros.html", livros=buscar_livros(),
                               erros=resp.json().get("errors"))
    return redirect(url_for("listar"))


@app.route("/livros/<int:livro_id>/excluir", methods=["POST"])
def excluir(livro_id):
    requests.delete(f"{API}/{livro_id}", headers=HEADERS, timeout=10)
    return redirect(url_for("listar"))


if __name__ == "__main__":
    app.run(port=5000, debug=True)
