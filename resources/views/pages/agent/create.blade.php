<form action="{{ route('agent.store') }}" method="POST">
    @csrf
    <label for="matricule">Matricule</label>
    <input id="matricule" type="text" name="matricule">
    <label for="nom">Nom</label>
    <input id="nom" type="text" name="nom">
    <label for="prenom">Prenom</label>
    <input id="prenom" type="text" name="prenom">
    <input type="submit" value="Valider">
</form>
