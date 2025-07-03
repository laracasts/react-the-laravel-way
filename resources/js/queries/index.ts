import { Puppy } from "../types";

// ------------------------------
// Get a list of puppies
// ------------------------------
export async function getPuppies() {
  const response = await fetch("http://react-backend.test/api/puppies", {
    headers: {
      accept: "application/json",
    },
  });
  if (!response.ok) {
    const errorData = await response.json();
    throw errorData;
  }
  const { data } = await response.json();
  return data;
}

// ------------------------------
// Add/remove from shortlist
// ------------------------------
export async function toggleLikedStatus(id: Puppy["id"]) {
  const response = await fetch(
    `http://react-backend.test/api/puppies/${id}/like`,
    {
      method: "PATCH",
      headers: {
        Accept: "application/json",
      },
    },
  );
  if (!response.ok) {
    const errorData = await response.json();
    throw errorData;
  }
  const { data } = await response.json();
  return data;
}

// ------------------------------
// Add a new puppy
// ------------------------------
export async function createPuppy(formData: FormData) {
  const response = await fetch("http://react-backend.test/api/puppies", {
    method: "POST",
    body: formData,
    headers: {
      Accept: "application/json",
    },
  });
  if (!response.ok) {
    const errorData = await response.json();
    throw errorData;
  }
  const data = await response.json();
  return data;
}
